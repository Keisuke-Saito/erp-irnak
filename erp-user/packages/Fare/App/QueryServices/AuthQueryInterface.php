<?php
declare(strict_types=1);

namespace Fare\App\QueryServices;

use Fare\App\Models\UserInfo;
use Fare\App\Port\InputAdapter;

/**
 * 従業員情報接続
 */
interface AuthQueryInterface
{
    /**
     * ErpIdで従業員取得
     *
     * @param InputAdapter $request
     * @return UserInfo
     */
    public function findFromRequestByErpId(InputAdapter $request): UserInfo;
}
