<?php
declare(strict_types=1);

namespace Fare\Domain\Repositories;

use Fare\App\Port\InputAdapter;
use Fare\Domain\Models\DeleteDetail\DeleteDetailModel;
use Fare\Domain\Models\UpdateDetail\UpdateDetailModel;
use Fare\Infrastructure\Base\Model\BaseDomainModel;

/**
 * 交通費情報処理
 */
interface FareRepositoryInterface
{
    /**
     * リクエストから交通費更新情報作成
     *
     * @param InputAdapter $request
     * @return UpdateDetailModel
     */
    public function newUpdate(InputAdapter $request): UpdateDetailModel;
    /**
     * 交通費レコードが存在しない
     *
     * @param BaseDomainModel $domainModel
     * @return bool
     */
    public function doesntExistFare(BaseDomainModel $domainModel): bool;
    /**
     * 交通費詳細レコードが存在しない
     *
     * @param BaseDomainModel $domainModel
     * @return bool
     */
    public function doesntExistFareDetail(BaseDomainModel $domainModel): bool;
    /**
     * 対象日が申請対象期間かチェック
     *
     * @param BaseDomainModel $domainModel
     * @return bool
     */
    public function isTargetTermWhereFareId(BaseDomainModel $domainModel): bool;
    /**
     * 交通費詳細情報を更新
     *
     * @param UpdateDetailModel $updateDetailModel
     * @return void
     */
    public function updateDetail(UpdateDetailModel $updateDetailModel): void;
    /**
     * リクエストから交通費削除情報作成
     *
     * @param InputAdapter $request
     * @return DeleteDetailModel
     */
    public function newDelete(InputAdapter $request): DeleteDetailModel;
    /**
     * 交通費詳細情報を削除
     *
     * @param DeleteDetailModel $deleteDetailModel
     * @return void
     */
    public function deleteDetail(DeleteDetailModel $deleteDetailModel): void;
}
