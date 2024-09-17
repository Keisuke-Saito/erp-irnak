<?php
declare(strict_types=1);

namespace Auth\App\QueryServices;

use Auth\App\Models\UserInfo;
use Auth\App\Port\InputAdapter;
use Auth\Infrastructure\Exceptions\NotFoundException;

/**
 * ワンタイムトークン情報取得に必要な処理
 */
interface OnetimeTokenQueryInterface
{
    /**
     * DBにユーザー登録用ワンタイムトークンが登録されているか
     *
     * @param InputAdapter $request
     * @return UserInfo
     * @throws NotFoundException
     */
    public function getUserInfoFromCreateUserToken(InputAdapter $request): UserInfo;
}
