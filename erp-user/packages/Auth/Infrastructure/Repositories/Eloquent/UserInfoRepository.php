<?php
declare(strict_types=1);

namespace Auth\Infrastructure\Repositories\Eloquent;

use App\Models as DBA;

use Auth\App\Port\InputAdapter;
use Auth\Domain\Factories\UserInfoFactory;
use Auth\Domain\Models\CreateUserInfo\CreateUserInfoModel;
use Auth\Domain\Repositories\UserInfoRepositoryInterface;

/**
 * Eloquent ユーザー情報リポジトリ
 * @property UserInfoFactory $userInfoFactory
 */
class UserInfoRepository implements UserInfoRepositoryInterface
{
    /** @var UserInfoFactory 認証情報モデル生成 */
    private $userInfoFactory;

    /**
     * Store a new controller instance.
     *
     * @param UserInfoFactory $userInfoFactory
     * @return void
     */
    public function __construct(
        UserInfoFactory $userInfoFactory
    ){
        $this->userInfoFactory = $userInfoFactory;
    }

    /**
     * リクエストからユーザー作成情報作成
     *
     * @param InputAdapter $request
     * @return CreateUserInfoModel
     */
    public function newCreateUserInfoModel(InputAdapter $request): CreateUserInfoModel
    {
        return $this->userInfoFactory->createFromRequest($request);
    }

    /**
     * メールアドレスの一意性確認
     *
     * @param CreateUserInfoModel $user
     * @return bool
     */
    public function emailNotExists(CreateUserInfoModel $user): bool
    {
        return DBA\User::where('hash_email', $user->getEmail()->getHashedValue())->doesntExist();
    }

    /**
     * ユーザー情報を登録
     *
     * @param CreateUserInfoModel $user
     * @return void
     */
    public function createUserInfo(CreateUserInfoModel $user): void
    {
        $user = new DBA\User($user->toUser());
        $user->save();
    }
}
