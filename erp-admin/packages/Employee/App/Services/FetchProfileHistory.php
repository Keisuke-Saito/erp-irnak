<?php
declare(strict_types=1);

namespace Employee\App\Services;

use Employee\App\QueryServices\EmployeeQueryInterface;
use Employee\App\Port\InputAdapter;
use Employee\Infrastructure\Port\Output\Response\FetchProfileHistoryResponse;

/**
 * ユーザー別情報履歴取得処理
 * @property EmployeeQueryInterface $employeeQuery
 */
final class FetchProfileHistory
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
     * ユーザー別情報履歴取得処理
     *
     * @param InputAdapter $request
     * @return FetchProfileHistoryResponse
     */
    public function execute(InputAdapter $request)
    {
        $profileHistory = $this->employeeQuery->profileHistory($request);
        return new FetchProfileHistoryResponse($profileHistory);
    }
}
