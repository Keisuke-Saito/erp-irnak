<?php
declare(strict_types=1);

namespace Employee\App\Services;

use Employee\Domain\Availability\ExistsEmployee;
use Employee\Domain\Availability\ExistsMaster;
use Employee\Domain\Availability\UniqEmail;
use Employee\Domain\Repositories\EmployeeRepositoryInterface;
use Employee\App\Port\InputAdapter;
/**
 * 従業員更新処理
 * @property ExistsEmployee $existsEmployee
 * @property ExistsMaster $existsMaster
 * @property UniqEmail $uniqEmail
 * @property EmployeeRepositoryInterface $employeeRepository
 */
final class Update
{
    /** @var ExistsEmployee 従業員情報が存在するかチェック */
    private $existsEmployee;
    /** @var ExistsMaster マスター情報が存在するかチェック */
    private $existsMaster;
    /** @var UniqEmail */
    private $uniqEmail;
    /** @var EmployeeRepositoryInterface 従業員情報接続 */
    private $employeeRepository;

    /**
     * Store a new controller instance.
     *
     * @param ExistsEmployee $existsMaster
     * @param ExistsMaster $existsMaster
     * @param UniqEmail $uniqEmail
     * @param EmployeeRepositoryInterface $employeeRepository
     * @return void
     */
    public function __construct(
        ExistsEmployee $existsEmployee,
        ExistsMaster $existsMaster,
        UniqEmail $uniqEmail,
        EmployeeRepositoryInterface $employeeRepository
    ){
        $this->existsEmployee = $existsEmployee;
        $this->existsMaster = $existsMaster;
        $this->uniqEmail = $uniqEmail;
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * 従業員更新処理
     *
     * @param InputAdapter $request
     * @return void
     */
    public function execute(InputAdapter $request)
    {
        // 更新モデル取得
        $updateDetailModel = $this->employeeRepository->newUpdate($request);

        // データの整合性チェック
        $this->existsEmployee->exists($updateDetailModel, [ExistsEmployee::PROFILE]);
        $this->existsMaster->exists($updateDetailModel);
        $this->uniqEmail->isUniqEmail($updateDetailModel);

        // 永続化
        $this->employeeRepository->updateEmployee($updateDetailModel);
    }
}
