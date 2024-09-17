<?php
declare(strict_types=1);

namespace Fare\Infrastructure\Repositories\Eloquent;

use App\Models\Fare;
use App\Models\FareDetail;

use Fare\App\Port\InputAdapter;
use Fare\Domain\Factories\FareFactory;
use Fare\Domain\Factories\FareDetailFactory;
use Fare\Domain\Models\ComfirmFare\ComfirmFareModel;
use Fare\Domain\Models\DeleteDetail\DeleteDetailModel;
use Fare\Domain\Models\StoreFare\StoreFareModel;
use Fare\Domain\Models\UpdateDetail\UpdateDetailModel;
use Fare\Domain\Storage\StorageInterface;
use Fare\Domain\Repositories\FareRepositoryInterface;
use Fare\Infrastructure\Base\Model\BaseDomainModel;

/**
 * Eloquent 交通費情報リポジトリ
 * @property FareFactory $fareFactory
 * @property FareDetailFactory $fareDetailFactory
 * @property StorageInterface $storage
 */
class FareRepository implements FareRepositoryInterface
{
    /** @var FareFactory 交通費情報モデル生成 */
    private $fareFactory;
    /** @var FareDetailFactory 交通費詳細情報モデル生成 */
    private $fareDetailFactory;
    /** @var StorageInterface ストレージ */
    private $storage;

    /**
     * Store a new controller instance.
     *
     * @param FareFactory $fareFactory
     * @param FareDetailFactory $fareDetailFactory
     * @param StorageInterface $storage
     * @return void
     */
    public function __construct(
        FareFactory $fareFactory,
        FareDetailFactory $fareDetailFactory,
        StorageInterface $storage
    ){
        $this->fareFactory = $fareFactory;
        $this->fareDetailFactory = $fareDetailFactory;
        $this->storage = $storage;
    }

    /**
     * リクエストから交通費新規登録情報作成
     *
     * @param InputAdapter $request
     * @return StoreFareModel
     */
    public function newStore(InputAdapter $request): StoreFareModel
    {
        return $this->fareFactory->createStoreFareModelFromRequest($request);
    }

    /**
     * 交通費永続化
     *
     * @param StoreFareModel $storeFareModel
     * @return void
     */
    public function storeFare(StoreFareModel $storeFareModel): void
    {
        $details = $storeFareModel->getDetail()->getValue();
        $fare = Fare::firstOrCreate($storeFareModel->toFare());
        foreach ($details->getItems() as $detail) {
            $detail = $this->storage->store($detail);
            $fareDetail = new FareDetail();
            $fareDetail->fare_id = $fare->uuid;
            $fareDetail->fill($detail->toFareDetail());
            $fareDetail->save();
        }
    }

    /**
     * リクエストから交通費更新情報作成
     *
     * @param InputAdapter $request
     * @return UpdateDetailModel
     */
    public function newUpdate(InputAdapter $request): UpdateDetailModel
    {
        return $this->fareDetailFactory->createUpdateModelFromRequest($request);
    }

    /**
     * 交通費レコードが存在しない
     *
     * @param BaseDomainModel $domainModel
     * @return bool
     */
    public function doesntExistFare(BaseDomainModel $domainModel): bool
    {
        return Fare::where('uuid', $domainModel->getFareId()->getValue())->doesntExist();
    }

    /**
     * 対象日が申請対象期間かチェック
     *
     * @param BaseDomainModel $domainModel
     * @return bool
     */
    public function isTargetTermWhereFareId(BaseDomainModel $domainModel): bool
    {
        $fare = Fare::find($domainModel->getFareId()->getValue());
        return $fare->target_month === $domainModel->getTargetDate()->carbon()->format('Y-m');
    }

    /**
     * 確定フラグ
     *
     * @param BaseDomainModel $domainModel
     * @return bool
     */
    public function isConfirmWhereErpId(BaseDomainModel $domainModel): bool
    {
        $fare = Fare::where($domainModel->toFare())->first();
        if (is_null($fare)) return false;
        if ($fare->confirm_status === Fare::CONFIRM_STATUS_FIXED
         || $fare->confirm_status === Fare::CONFIRM_STATUS_AUTO_FIXED
         || $fare->confirm_status === Fare::CONFIRM_STATUS_VERIFID) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 確定フラグ
     *
     * @param BaseDomainModel $domainModel
     * @return bool
     */
    public function isConfirmWhereFareId(BaseDomainModel $domainModel): bool
    {
        $fare = Fare::find($domainModel->getFareId()->getValue());
        if ($fare->confirm_status === Fare::CONFIRM_STATUS_FIXED
         || $fare->confirm_status === Fare::CONFIRM_STATUS_AUTO_FIXED
         || $fare->confirm_status === Fare::CONFIRM_STATUS_VERIFID) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 交通費詳細情報を更新
     *
     * @param UpdateDetailModel $updateDetailModel
     * @return void
     */
    public function updateDetail(UpdateDetailModel $updateDetailModel): void
    {
        $fareDetail = FareDetail::find($updateDetailModel->getId());

        $updateDetailModel->setFilePath($fareDetail->receipt);
        $updateDetailModel = $this->storage->update($updateDetailModel);

        $updateValues = $updateDetailModel->toArray();

        $fareDetail->target_date = $updateValues['targetDate'];
        $fareDetail->destination = $updateValues['destination'];
        $fareDetail->point_of_departure = $updateValues['pointOfDeparture'];
        $fareDetail->arrival = $updateValues['arrival'];
        $fareDetail->route_div = $updateValues['routeDiv'];
        $fareDetail->transportation = $updateValues['transportation'];
        $fareDetail->amount_of_money = $updateValues['amountOfMoney'];
        $fareDetail->remarks = $updateValues['remarks'];
        $fareDetail->receipt = $updateValues['filePath'];
        $fareDetail->save();
    }

    /**
     * リクエストから交通費削除情報作成
     *
     * @param InputAdapter $request
     * @return DeleteDetailModel
     */
    public function newDelete(InputAdapter $request): DeleteDetailModel
    {
        $deleteDetail = $this->fareDetailFactory->createDeleteModelFromRequest($request);
        $fareDetail = FareDetail::find($deleteDetail->getId());
        $fare = Fare::find($fareDetail->fare_id);
        $deleteDetail->setFareId($fare->uuid);
        return $deleteDetail;
    }

    /**
     * 交通費詳細情報を削除
     *
     * @param DeleteDetailModel $deleteDetailModel
     * @return void
     */
    public function deleteDetail(DeleteDetailModel $deleteDetailModel): void
    {
        $fareDetail = FareDetail::find($deleteDetailModel->getId());
        if (!is_null($fareDetail->receipt)) {
            $deleteDetailModel->setFilePath($fareDetail->receipt);
            $this->storage->delete($deleteDetailModel);
        }
        $fareDetail->forceDelete();
    }

    /**
     * リクエストから交通費確定情報作成
     *
     * @param InputAdapter $request
     * @return ComfirmFareModel
     */
    public function newComfirm(InputAdapter $request): ComfirmFareModel
    {
        return $this->fareFactory->createComfirmModelFromRequest($request);
    }

    /**
     * 交通費確定
     *
     * @param ComfirmFareModel $comfirmFareModel
     * @return void
     */
    public function comfirmFare(ComfirmFareModel $comfirmFareModel): void
    {
        $fare = Fare::find($comfirmFareModel->getId());
        $fare->confirm_status = Fare::CONFIRM_STATUS_FIXED;
        $fare->save();
    }
}
