<?php
declare(strict_types=1);

namespace Employee\Infrastructure\Repositories\Eloquent;

use App\Models\Profile;
use App\Models\User;

use Employee\App\Port\InputAdapter;
use Employee\Domain\Models\Delete\DeleteModel;
use Employee\Domain\Models\Store\StoreModel;
use Employee\Domain\Models\UpdateDetail\UpdateDetailModel;
use Employee\Domain\Factories\EmployeeFactory;
use Employee\Domain\Repositories\EmployeeRepositoryInterface;
use Employee\Infrastructure\Base\Model\BaseDomainModel;

/**
 * Eloquent 従業員リポジトリ
 *
 * @property EmployeeFactory $employeeFactory
 */
class EmployeeRepository implements EmployeeRepositoryInterface
{
    /** @var EmployeeFactory 従業員モデル生成 */
    private $employeeFactory;

    /**
     * Store a new controller instance.
     *
     * @param EmployeeFactory $employeeFactory
     * @return void
     */
    public function __construct(
        EmployeeFactory $employeeFactory
    ){
        $this->employeeFactory = $employeeFactory;
    }

    /**
     * 新規従業員モデル生成
     *
     * @param InputAdapter $request
     * @return StoreModel
     */
    public function newStoreModel(InputAdapter $request): StoreModel
    {
        return $this->employeeFactory->createStoreModelFromRequest($request);
    }

    /**
     * メールアドレスの一意性確認
     *
     * @param BaseDomainModel $domainModel
     * @return bool
     */
    public function emailExists(BaseDomainModel $domainModel): bool
    {
        return User::withTrashed()->where('hash_email', $domainModel->getEmail()->getHashedValue())->where('erp_id' , '!=' , $domainModel->getErpId()->getValue())->exists();
    }

    /**
     * 設定値がマスターに存在するかチェック
     *
     * @param BaseDomainModel $domainModel
     * @return string
     */
    public function existsMstValues(BaseDomainModel $domainModel): string
    {
        $profile = new Profile($domainModel->toProfile());
        foreach ($domainModel->toRelationMstMethod() as $key => $value) {
            if (is_null($profile->$key)) return $key;
        }
        return '';
    }

    /**
     * 新規従業員登録情報をDBへ登録
     *
     * @param BaseDomainModel $domainModel
     * @return void
     */
    public function createProfile(BaseDomainModel $domainModel)
    {
        $profile = new Profile($domainModel->toProfile());
        $profile->save();
    }

    /**
     * リクエストから従業員更新情報作成
     *
     * @param InputAdapter $request
     * @return UpdateDetailModel
     */
    public function newUpdate(InputAdapter $request): UpdateDetailModel
    {
        return $this->employeeFactory->createUpdateModelFromRequest($request);
    }

    /**
     * ログイン情報の存在確認
     *
     * @param BaseDomainModel $domainModel
     * @return bool
     */
    public function userExists(BaseDomainModel $domainModel): bool
    {
        return User::withTrashed()->where('erp_id', $domainModel->getErpId()->getValue())->exists();
    }

    /**
     * 従業員情報の存在確認
     *
     * @param BaseDomainModel $domainModel
     * @return bool
     */
    public function profileExists(BaseDomainModel $domainModel): bool
    {
        return Profile::withTrashed()->where('uuid', $domainModel->getId())->exists();
    }

    /**
     * 従業員詳細情報を更新
     *
     * @param UpdateDetailModel $updateDetailModel
     * @return void
     */
    public function updateEmployee(UpdateDetailModel $updateDetailModel): void
    {
        // 現在のプロフィールをソフトデリート
        Profile::where('erp_id', $updateDetailModel->getErpId()->getValue())->delete();
        // 新規でプロフィールを登録
        $this->createProfile($updateDetailModel);
        // ログインユーザーのEmailを更新
        if ($this->userExists($updateDetailModel)) {
            $user = User::withTrashed()->where('erp_id', $updateDetailModel->getErpId()->getValue())->first();
            $user->hash_email = $updateDetailModel->getEmail()->getHashedValue();
            $user->save();
        }
    }

    /**
     * リクエストからログイン削除情報作成
     *
     * @param InputAdapter $request
     * @return DeleteModel
     */
    public function newDelete(InputAdapter $request): DeleteModel
    {
        return $this->employeeFactory->createDeleteModelFromRequest($request);
    }

    /**
     * ログイン情報削除
     *
     * @param BaseDomainModel $domainModel
     * @return void
     */
    public function deleteUser(BaseDomainModel $domainModel): void
    {
        User::where('erp_id', $domainModel->getErpId()->getValue())->delete();
    }
}
