<?php
declare(strict_types=1);

namespace Employee\App\Services;

use Employee\App\Port\InputAdapter;
use Employee\App\QueryServices\CsvQueryInterface;
use Employee\App\QueryServices\EmployeeQueryInterface;
use Employee\Infrastructure\Port\Output\Response\CsvResponse;

/**
 * csv情報取得処理
 * @property CsvQueryInterface $csvQuery
 * @property EmployeeQueryInterface $employeeQuery
 */
final class EmployeeListCsvDounload
{
    /** @var CsvQueryInterface csvファイルモデル生成 */
    private $csvQuery;
    /** @var EmployeeQueryInterface 従業員情報接続 */
    private $employeeQuery;

    /**
     * Store a new controller instance.
     *
     * @param CsvQueryInterface $csvQuery
     * @param EmployeeQueryInterface $employeeQuery
     * @return void
     */
    public function __construct(
        CsvQueryInterface $csvQuery,
        EmployeeQueryInterface $employeeQuery
    ){
        $this->csvQuery = $csvQuery;
        $this->employeeQuery = $employeeQuery;
    }

    /**
     * csv情報取得処理
     *
     * @param InputAdapter $request
     * @return CsvResponse
     */
    public function execute(InputAdapter $request)
    {
        // 対象月の従業員情報を取得
        $employeeCsv = $this->employeeQuery->getEmployeeCsvDataByTargetMonth($request);
        // CSVデータを取得
        $csv = $this->csvQuery->getCsv($employeeCsv);

        return new CsvResponse($csv);
    }
}
