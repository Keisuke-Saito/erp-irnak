<?php
declare(strict_types=1);

namespace Fare\App\Services;

use Fare\App\QueryServices\EmployeeQueryInterface;
use Fare\App\QueryServices\FareQueryInterface;
use Fare\App\Port\InputAdapter;
use Fare\Infrastructure\Port\Output\Response\FetchTargetMonthResponse;

/**
 * 交通費情報取得処理
 * @property EmployeeQueryInterface $employeeQuery
 * @property FareQueryInterface $fareQuery
 */
final class FetchTargetMonth
{
    /** @var EmployeeQueryInterface 交通費情報接続 */
    private $employeeQuery;
    /** @var FareQueryInterface 交通費情報接続 */
    private $fareQuery;

    /**
     * Store a new controller instance.
     *
     * @param EmployeeQueryInterface $employeeQuery
     * @param FareQueryInterface $fareQuery
     * @return void
     */
    public function __construct(
        EmployeeQueryInterface $employeeQuery,
        FareQueryInterface $fareQuery
    ){
        $this->employeeQuery = $employeeQuery;
        $this->fareQuery = $fareQuery;
    }

    /**
     * 交通費情報取得処理
     *
     * @param InputAdapter $request
     * @return FetchTargetMonthResponse
     */
    public function execute(InputAdapter $request)
    {
        // 対象月に在籍している従業員取得
        $enrollmentEmployees = $this->employeeQuery->getEnrollmentFromTargetMonth($request);
        // 対象月の在籍中の社員の交通費情報を３ヶ月分取得
        $targetFares = $this->fareQuery->getThreeMonthsCount($request, $enrollmentEmployees);
        return new FetchTargetMonthResponse($targetFares);
    }
}
