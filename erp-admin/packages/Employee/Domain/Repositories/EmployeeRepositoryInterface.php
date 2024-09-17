<?php
declare(strict_types=1);

namespace Employee\Domain\Repositories;

use Employee\App\Port\InputAdapter;
use Employee\Domain\Models\Store\StoreModel;
use Employee\Domain\Models\UpdateDetail\UpdateDetailModel;
use Employee\Domain\Models\Delete\DeleteModel;
use Employee\Infrastructure\Base\Model\BaseDomainModel;

/**
 * 社員登録情報処理
 */
interface EmployeeRepositoryInterface
{
    /**
     * 新規従業員モデル生成
     *
     * @param InputAdapter $request
     * @return StoreModel
     */
    public function newStoreModel(InputAdapter $request): StoreModel;

    /**
     * メールアドレスの一意性確認
     *
     * @param BaseDomainModel $domainModel
     * @return bool
     */
    public function emailExists(BaseDomainModel $domainModel): bool;

    /**
     * 設定値がマスターに存在するかチェック
     *
     * @param BaseDomainModel $domainModel
     * @return string
     */
    public function existsMstValues(BaseDomainModel $domainModel): string;

    /**
     * 新規従業員登録情報をDBへ登録
     *
     * @param BaseDomainModel $domainModel
     * @return void
     */
    public function createProfile(BaseDomainModel $domainModel);

    /**
     * リクエストから従業員更新情報作成
     *
     * @param InputAdapter $request
     * @return UpdateDetailModel
     */
    public function newUpdate(InputAdapter $request): UpdateDetailModel;

    /**
     * 新規従業員情報が存在するか確認
     *
     * @param BaseDomainModel $domainModel
     * @return bool
     */
    public function userExists(BaseDomainModel $domainModel): bool;

    /**
     * メールアドレスの一意性確認
     *
     * @param BaseDomainModel $domainModel
     * @return bool
     */
    public function profileExists(BaseDomainModel $domainModel): bool;

    /**
     * 従業員詳細情報を更新
     *
     * @param UpdateDetailModel $updateDetailModel
     * @return void
     */
    public function updateEmployee(UpdateDetailModel $updateDetailModel): void;

    /**
     * リクエストからログイン削除情報作成
     *
     * @param InputAdapter $request
     * @return DeleteModel
     */
    public function newDelete(InputAdapter $request): DeleteModel;

    /**
     * ログイン情報削除
     *
     * @param BaseDomainModel $domainModel
     * @return void
     */
    public function deleteUser(BaseDomainModel $domainModel): void;
}
