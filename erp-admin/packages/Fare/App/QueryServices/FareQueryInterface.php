<?php
declare(strict_types=1);

namespace Fare\App\QueryServices;

use Fare\App\Models\FareDetailTargetMonth;
use Fare\App\Collections\FareCollection;
use Fare\App\Collections\EmployeeCollection;
use Fare\App\Port\InputAdapter;

/**
 * 交通費情報接続
 */
interface FareQueryInterface
{
    /**
     * 対象月の交通費詳細情報取得
     *
     * @param InputAdapter $request
     * @return FareDetailTargetMonth
     */
    public function getDetailByTargetMonth(InputAdapter $request): FareDetailTargetMonth;
    /**
     * 対象月の在籍中の社員の交通費情報を全件取得
     *
     * @param InputAdapter $request
     * @param EmployeeCollection $enrollmentEmployees
     * @return FareCollection
     */
    public function getThreeMonthsCount(
        InputAdapter $request, EmployeeCollection $enrollmentEmployees): FareCollection;
}
