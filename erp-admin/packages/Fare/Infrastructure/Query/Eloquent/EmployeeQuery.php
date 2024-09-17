<?php
declare(strict_types=1);

namespace Fare\Infrastructure\Query\Eloquent;

use App\Models as DBA;

use Illuminate\Support\Collection as LaravelCollection;

use Fare\App\Models\Employee;
use Fare\App\Collections\EmployeeCollection;
use Fare\App\QueryServices\EmployeeQueryInterface;
use Fare\App\Port\InputAdapter;

use Carbon\Carbon;

/**
 * Eloquent 従業員情報クエリ
 */
final class EmployeeQuery implements EmployeeQueryInterface
{
    /**
     * 対象月に在籍している従業員取得
     * 登録が完了していない、または
     * 入社前情報/対象月より前に退職している,以外のデータ
     *
     * @param InputAdapter $request
     * @return EmployeeCollection
     */
    public function getEnrollmentFromTargetMonth(InputAdapter $request): EmployeeCollection
    {
        $targetDateTime = new Carbon($request->get('target'));
        $allEmployeeModels = DBA\Profile::whereNotNull('joined_at')
            ->where(function ($query) use ($targetDateTime) {
                $target = $targetDateTime->copy()->endOfMonth()->toDateString();
                $query->whereDate('joined_at', '<=', $target);
            })
            ->where(function ($query) use ($targetDateTime) {
                $target = $targetDateTime->copy()->startOfMonth()->toDateString();
                $query->whereDate('retirement_at', '>=', $target)
                      ->orWhereNull('retirement_at');
            })
            ->doesntHave('onetimeToken')
            ->get();
        $checkList = [];
        foreach ($allEmployeeModels as $index => $dbModel) {
            $erpId = $dbModel->erp_id;
            $createdAt = $dbModel->created_at;
            if (array_key_exists($erpId, $checkList)) {
                $checkIndex = $checkList[$erpId];
                $checkCreatedAt = $allEmployeeModels->get($checkIndex)->created_at;
                if ($checkCreatedAt <= $createdAt) {
                    $allEmployeeModels->forget($checkIndex);
                    $checkList[$erpId] = $index;
                } else {
                    $allEmployeeModels->forget($index);
                }
            } else {
                $checkList[$erpId] = $index;
            }
        }
        return $this->dbModelConvert($allEmployeeModels);
    }

    /**
     * Eloquent/collectionから変換
     *
     * @param LaravelCollection $dbModels
     * @return EmployeeCollection
     */
    private function dbModelConvert(LaravelCollection $dbModels): EmployeeCollection
    {
        $collection = new EmployeeCollection();
        foreach ($dbModels as $dbModel) {
            $model = new Employee();
            $model->fill($dbModel->toArray());
            $collection->push($model);
        }
        return $collection;
    }
}
