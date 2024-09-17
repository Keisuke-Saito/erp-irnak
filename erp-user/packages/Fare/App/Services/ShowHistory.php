<?php
declare(strict_types=1);

namespace Fare\App\Services;

use Fare\App\QueryServices\AuthQueryInterface;
use Fare\App\QueryServices\FareQueryInterface;
use Fare\App\Port\InputAdapter;
use Fare\Infrastructure\Port\Output\Response\ShowHistoryResponse;

/**
 * 交通費履歴情報取得処理
 * @property AuthQueryInterface $authQuery
 * @property FareQueryInterface $fareQuery
 */
final class ShowHistory
{
    /** @var AuthQueryInterface 交通費履歴情報接続 */
    private $authQuery;
    /** @var FareQueryInterface 交通費履歴情報接続 */
    private $fareQuery;

    /**
     * Store a new controller instance.
     *
     * @param AuthQueryInterface $authQuery
     * @param FareQueryInterface $fareQuery
     * @return void
     */
    public function __construct(
        AuthQueryInterface $authQuery,
        FareQueryInterface $fareQuery
    ){
        $this->authQuery = $authQuery;
        $this->fareQuery = $fareQuery;
    }

    /**
     * 交通費履歴情報取得処理
     *
     * @param InputAdapter $request
     * @return ShowHistoryResponse
     */
    public function execute(InputAdapter $request)
    {
        // ErpIdで従業員取得
        $userInfo = $this->authQuery->findFromRequestByErpId($request);
        // 対象月の交通費履歴情報取得
        $targetFares = $this->fareQuery->getDetailByTargetMonth($request, $userInfo);
        return new ShowHistoryResponse($targetFares);
    }
}
