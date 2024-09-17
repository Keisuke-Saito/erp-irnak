<?php
declare(strict_types=1);

namespace Employee\App\Services;

use Employee\Domain\Availability\ExistsEmployee;
use Employee\Domain\Repositories\EmployeeRepositoryInterface;
use Employee\App\Port\InputAdapter;
/**
 * 従業員ログイン情報削除処理
 * @property ExistsEmployee $existsEmployee
 * @property EmployeeRepositoryInterface $employeeRepository
 */
final class Delete
{
    /** @var ExistsEmployee 従業員情報が存在するかチェック */
    private $existsEmployee;
    /** @var EmployeeRepositoryInterface 従業員情報接続 */
    private $employeeRepository;

    /**
     * Store a new controller instance.
     *
     * @param ExistsEmployee $existsMaster
     * @param EmployeeRepositoryInterface $employeeRepository
     * @return void
     */
    public function __construct(
        ExistsEmployee $existsEmployee,
        EmployeeRepositoryInterface $employeeRepository
    ){
        $this->existsEmployee = $existsEmployee;
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * 従業員ログイン情報削除処理
     *
     * @param InputAdapter $request
     * @return void
     */
    public function execute(InputAdapter $request)
    {
        // ログイン情報削除モデル取得
        $deleteModel = $this->employeeRepository->newDelete($request);

        // データの整合性チェック
        $this->existsEmployee->exists($deleteModel, [ExistsEmployee::USER]);

        // 永続化
        $this->employeeRepository->deleteUser($deleteModel);
    }
}
