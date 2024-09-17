<?php
declare(strict_types=1);

namespace Auth\Domain\Repositories;

use Auth\Domain\Models\CreateUserInfo\CreateUserInfoModel;

/**
 * ワンタイムトークン情報処理
 */
interface OnetimeTokenRepositoryInterface
{
    /**
     * ワンタイムトークンが登録されているか
     *
     * @param CreateUserInfoModel $user
     * @return bool
     */
    public function isExistsToken(CreateUserInfoModel $user): bool;
}
