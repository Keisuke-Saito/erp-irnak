<?php
declare(strict_types=1);

namespace Auth\App\QueryServices;

use Auth\App\Collections\ProfileCollection;
use Auth\App\Port\InputAdapter;
use Auth\Infrastructure\Exceptions\NotFoundException;

/**
 * ユーザー情報接続
 */
interface UserInfoQueryInterface
{
    /**
     * ErpIdで従業員取得
     *
     * @param InputAdapter $request
     * @return ProfileCollection
     * @throws NotFoundException
     */
    public function findFromRequestByErpId(InputAdapter $request): ProfileCollection;
}
