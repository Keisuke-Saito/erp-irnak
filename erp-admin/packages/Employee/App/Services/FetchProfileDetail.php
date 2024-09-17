<?php
declare(strict_types=1);

namespace Employee\App\Services;

use Employee\App\QueryServices\EmployeeQueryInterface;
use Employee\App\Port\InputAdapter;
use Employee\Infrastructure\Port\Output\Response\FetchProfileDetailResponse;

/**
 * 従業員詳細情報取得処理
 * @property EmployeeQueryInterface $employeeQuery
 */
final class FetchProfileDetail
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
     * 従業員詳細情報取得処理
     *
     * @param InputAdapter $request
     * @return FetchProfileDetailResponse
     */
    public function execute(InputAdapter $request)
    {
        $profileDetail = $this->employeeQuery->profileDetail($request);
        return new FetchProfileDetailResponse($profileDetail);
    }
}
