<?php
declare(strict_types=1);

namespace Employee\App\QueryServices;

use Employee\App\Models\CsvData;
use Employee\App\Models\Employee;
use Employee\App\Collections\EmployeeCollection;
use Employee\App\Port\InputAdapter;

/**
 * 従業員情報接続
 */
interface EmployeeQueryInterface
{
    /**
     * 対象月の社員のcsv情報を取得
     *
     * @param InputAdapter $request
     * @return CsvData
     */
    public function getEmployeeCsvDataByTargetMonth(InputAdapter $request): CsvData;

    /**
     * 全従業員取得
     *
     * @return EmployeeCollection
     */
    public function allEmployee(): EmployeeCollection;


    /**
     * 従業員詳細取得
     *
     *@param InputAdapter $request
     * @return EmployeeCollection
     */
    public function profileHistory(InputAdapter $request): EmployeeCollection;


    /**
     * 従業員詳細取得
     *
     *@param InputAdapter $request
     * @return Employee
     */
    public function profileDetail(InputAdapter $request): Employee;
}
