<?php
declare(strict_types=1);

namespace Auth\Domain\Repositories;

use Auth\App\Port\InputAdapter;
use Auth\Domain\Models\CreateUserInfo\CreateUserInfoModel;

/**
 * ユーザー情報処理
 */
interface UserInfoRepositoryInterface
{
    /**
     * リクエストからユーザー作成情報作成
     *
     * @param InputAdapter $request
     * @return CreateUserInfoModel
     */
    public function newCreateUserInfoModel(InputAdapter $request): CreateUserInfoModel;
    /**
     * メールアドレスの一意性確認
     *
     * @param CreateUserInfoModel $user
     * @return bool
     */
    public function emailNotExists(CreateUserInfoModel $user): bool;
    /**
     * ユーザー情報を登録
     *
     * @param CreateUserInfoModel $user
     * @return void
     */
    public function createUserInfo(CreateUserInfoModel $user): void;
}
