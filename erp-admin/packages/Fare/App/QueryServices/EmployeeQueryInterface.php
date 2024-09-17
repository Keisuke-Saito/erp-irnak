<?php
declare(strict_types=1);

namespace Fare\App\QueryServices;

use Fare\App\Models\Employee;
use Fare\App\Collections\EmployeeCollection;
use Fare\App\Port\InputAdapter;

/**
 * 従業員情報接続
 */
interface EmployeeQueryInterface
{
    /**
     * 対象月に在籍している全従業員取得
     *
     * @param InputAdapter $request
     * @return EmployeeCollection
     */
    public function getEnrollmentFromTargetMonth(InputAdapter $request): EmployeeCollection;
}
