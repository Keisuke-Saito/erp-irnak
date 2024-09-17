<?php
declare(strict_types=1);

namespace Fare\Infrastructure\Repositories\Eloquent;

use App\Models\Fare;
use App\Models\FareDetail;

use Fare\App\Port\InputAdapter;
use Fare\Domain\Factories\FareDetailFactory;
use Fare\Domain\Models\DeleteDetail\DeleteDetailModel;
use Fare\Domain\Models\UpdateDetail\UpdateDetailModel;
use Fare\Domain\Storage\StorageInterface;
use Fare\Domain\Repositories\FareRepositoryInterface;
use Fare\Infrastructure\Base\Model\BaseDomainModel;

/**
 * Eloquent 交通費情報リポジトリ
 * @property FareDetailFactory $fareDetailFactory
 * @property StorageInterface $storage
 */
class FareRepository implements FareRepositoryInterface
{
    /** @var FareDetailFactory 交通費詳細情報モデル生成 */
    private $fareDetailFactory;
    /** @var StorageInterface ストレージ */
    private $storage;

    /**
     * Store a new controller instance.
     *
     * @param FareDetailFactory $fareDetailFactory
     * @param StorageInterface $storage
     * @return void
     */
    public function __construct(
        FareDetailFactory $fareDetailFactory,
        StorageInterface $storage
    ){
        $this->fareDetailFactory = $fareDetailFactory;
        $this->storage = $storage;
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
     * 交通費詳細レコードが存在しない
     *
     * @param BaseDomainModel $domainModel
     * @return bool
     */
    public function doesntExistFareDetail(BaseDomainModel $domainModel): bool
    {
        return FareDetail::where('uuid', $domainModel->getId())->doesntExist();
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
        $fareDetail->admin_remarks = $updateValues['adminRemarks'];
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
        return $this->fareDetailFactory->createDeleteModelFromRequest($request);
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
}
