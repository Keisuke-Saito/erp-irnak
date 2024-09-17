<?php
declare(strict_types=1);

namespace Common\Infrastructure\Query\Eloquent;

use App\Models as DBA;
use Illuminate\Support\Collection as LaravelCollection;
use Common\App\Collections\Collection;
use Common\App\Collections\MstCollection;
use Common\App\QueryServices\CommonMstQueryInterface;

/**
 * Eloquent 一般マスタ情報リポジトリ
 */
class CommonMstQuery implements CommonMstQueryInterface
{
    /**
     * 一般マスタ情報全件取得
     *
     * @return MstCollection
     */
    public function all(): MstCollection
    {
        $allBelongMst = DBA\BelongMst::all();
        $belongMsts = $this->dbModelConvert($allBelongMst);
        $allAffiliationDeptMst = DBA\AffiliationDeptMst::all();
        $affiliationDeptMst = $this->dbModelConvert($allAffiliationDeptMst);
        $allPositionMst = DBA\PositionMst::all();
        $positionMst = $this->dbModelConvert($allPositionMst);
        $allEmployeeDivMst = DBA\EmployeeDivMst::all();
        $employeeDivMst = $this->dbModelConvert($allEmployeeDivMst);
        $allBusinessDivMst = DBA\BusinessDivMst::all();
        $businessDivMst = $this->dbModelConvert($allBusinessDivMst);
        return new MstCollection([
            'belongMst' => $belongMsts,
            'affiliationDeptMst' => $affiliationDeptMst,
            'positionMst' => $positionMst,
            'employeeDivMst' => $employeeDivMst,
            'businessDivMst' => $businessDivMst
        ]);
    }

    /**
     * Eloquent/collectionから変換
     *
     * @return LaravelCollection $dbModels
     * @return Collection
     */
    private function dbModelConvert(LaravelCollection $dbModels): Collection
    {
        $collection = new Collection();
        foreach ($dbModels as $dbModel) {
            $className = 'Common\\' . get_class($dbModel);
            $model = new $className();
            $model->fill($dbModel->toArray());
            $collection->push($model);
        }
        return $collection;
    }
}
