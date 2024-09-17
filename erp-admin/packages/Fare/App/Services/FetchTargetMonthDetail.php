<?php
declare(strict_types=1);

namespace Fare\App\Services;

use Fare\App\QueryServices\FareQueryInterface;
use Fare\App\Port\InputAdapter;
use Fare\Infrastructure\Port\Output\Response\FetchTargetMonthDetailResponse;

/**
 * 交通費詳細情報取得処理
 * @property FareQueryInterface $fareQuery
 */
final class FetchTargetMonthDetail
{
    /** @var FareQueryInterface 交通費詳細情報接続 */
    private $fareQuery;

    /**
     * Store a new controller instance.
     *
     * @param FareQueryInterface $fareQuery
     * @return void
     */
    public function __construct(
        FareQueryInterface $fareQuery
    ){
        $this->fareQuery = $fareQuery;
    }

    /**
     * 交通費詳細情報取得処理
     *
     * @param InputAdapter $request
     * @return FetchTargetMonthDetailResponse
     */
    public function execute(InputAdapter $request)
    {
        // 対象月の交通費詳細情報取得
        $targetFares = $this->fareQuery->getDetailByTargetMonth($request);
        return new FetchTargetMonthDetailResponse($targetFares);
    }
}
