<?php
declare(strict_types=1);

namespace Employee\App\Services;

use Employee\App\QueryServices\EmployeeQueryInterface;
use Employee\Infrastructure\Port\Output\Response\FetchAllEmployeeResponse;

/**
 * 全従業員情報取得処理
 * @property EmployeeQueryInterface $employeeQuery
 */
final class FetchAllEmployee
{
    /** @var EmployeeQueryInterface 従業員情報接続 */
    private $employeeQuery;

    /**
     * Store a new controller instance.
     *
     * @param EmployeeQueryInterface $employeeQuery
     * @return void
     */
    public function __construct(
        EmployeeQueryInterface $employeeQuery
    ){
        $this->employeeQuery = $employeeQuery;
    }

    /**
     * 全従業員情報取得処理
     *
     * @return FetchAllEmployeeResponse
     */
    public function execute()
    {
        $allEmployee = $this->employeeQuery->allEmployee();
        return new FetchAllEmployeeResponse($allEmployee);
    }
}
