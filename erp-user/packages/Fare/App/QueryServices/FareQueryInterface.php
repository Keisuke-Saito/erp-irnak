<?php
declare(strict_types=1);

namespace Fare\App\QueryServices;

use Fare\App\Models\UserInfo;
use Fare\App\Collections\FareDetailCollection;
use Fare\App\Port\InputAdapter;

/**
 * 交通費情報接続
 */
interface FareQueryInterface
{
    /**
     * 対象月の交通費詳細情報取得
     *
     * @param InputAdapter $request
     * @param UserInfo $userInfo
     * @return FareDetailCollection
     */
    public function getDetailByTargetMonth(
        InputAdapter $request, UserInfo $userInfo): FareDetailCollection;
}
