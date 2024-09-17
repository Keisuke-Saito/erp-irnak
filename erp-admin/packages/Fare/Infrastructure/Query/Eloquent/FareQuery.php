<?php
declare(strict_types=1);

namespace Fare\Infrastructure\Query\Eloquent;

use App\Models as DBA;

use Fare\App\Models\FareDetail;
use Fare\App\Models\FareDetailTargetMonth;
use Fare\App\Models\ThreeMonthsTotalFare;
use Fare\App\Collections\FareCollection;
use Fare\App\Collections\FareDetailCollection;
use Fare\App\Collections\EmployeeCollection;
use Fare\App\QueryServices\FareQueryInterface;
use Fare\App\Port\InputAdapter;

/**
 * Eloquent 交通費情報クエリ
 */
final class FareQuery implements FareQueryInterface
{
    /**
     * 対象月の交通費詳細情報取得
     *
     * @param InputAdapter $request
     * @return FareDetailTargetMonth
     */
    public function getDetailByTargetMonth(InputAdapter $request): FareDetailTargetMonth
    {
        $user = DBA\User::withTrashed()->where('erp_id', $request->get('erpId'))->firstOrFail();
        $profile = $user->profile()->first();

        $eloquentFare = DBA\Fare::firstOrNew([
            'erp_id' => $user->erp_id,
            'target_month' => $request->get('target')->format('Y-m')
        ], [
            'confirm_status' => DBA\Fare::CONFIRM_STATUS_UNSUBMITTED
        ]);

        $fareDetailCollection = new FareDetailCollection();
        $eloquentFareDetails = $eloquentFare->fareDetail()->orderBy('target_date', 'asc')->get();
        foreach ($eloquentFareDetails as $eloquentFareDetail) {
            $fareDetail = new FareDetail();
            $fareDetail->fill($eloquentFareDetail->toArray());
            $fareDetailCollection->push($fareDetail);
        }

        $fare = new FareDetailTargetMonth();
        $fare->fill($eloquentFare->toArray());
        $fare->fill([
            'name' => $profile->name,
            'kana' => $profile->kana,
            'nearestStation' => $profile->nearest_station,
            'belongId' => $profile->belong_id,
            'retirementAt' => $profile->retirement_at,
            'details' => $fareDetailCollection
        ]);
        return $fare;
    }

    /**
     * 対象月の在籍中の社員の交通費情報を全件取得
     *
     * @param InputAdapter $request
     * @param EmployeeCollection $enrollmentEmployees
     * @return FareCollection
     */
    public function getThreeMonthsCount(
        InputAdapter $request,
        EmployeeCollection $enrollmentEmployees
    ): FareCollection {
        $fareCollection = new FareCollection();
        $targetDateTime = $request->get('target');
        $fareCollection->setTarget($targetDateTime);
        $target = $fareCollection->getTarget();
        $idList = $enrollmentEmployees->getDeepProperty('erpId')->toArray();

        $thisMonthFares = DBA\Fare::whereIn('erp_id', $idList)
            ->where('target_month', $target)
            ->get();

        $lastMonth = $targetDateTime->copy()->subMonthNoOverflow(1)->format('Y-m');
        $lastMonthFares = DBA\Fare::whereIn('erp_id', $idList)
            ->where('target_month', $lastMonth)
            ->get();

        $twoMonthsAgo = $targetDateTime->copy()->subMonthNoOverflow(2)->format('Y-m');
        $twoMonthsAgoFares = DBA\Fare::whereIn('erp_id', $idList)
            ->where('target_month', $twoMonthsAgo)
            ->get();

        foreach ($enrollmentEmployees->getItems() as $employee) {
            $thisMonthFare = $thisMonthFares->where('erp_id', $employee->getErpId())->first();
            $thisMonthTotal = is_null($thisMonthFare) ? 0 : $thisMonthFare->fareDetail()->get()->sum('amount_of_money');
            $lastMonthFare = $lastMonthFares->where('erp_id', $employee->getErpId())->first();
            $lastMonthTotal = is_null($lastMonthFare) ? 0 : $lastMonthFare->fareDetail()->get()->sum('amount_of_money');
            $twoMonthsAgoFare = $twoMonthsAgoFares->where('erp_id', $employee->getErpId())->first();
            $twoMonthsAgoTotal = is_null($twoMonthsAgoFare) ? 0 : $twoMonthsAgoFare->fareDetail()->get()->sum('amount_of_money');

            $model = new ThreeMonthsTotalFare();
            $model->fill([
                'erpId' => $employee->getErpId(),
                'name' => $employee->getName(),
                'belongId' => $employee->getBelongId(),
                'targetMonth' => $target,
                'confirmStatus' => $thisMonthFare->confirm_status ?? DBA\Fare::CONFIRM_STATUS_UNSUBMITTED,
                'thisMonthCount' => $thisMonthTotal,
                'lastMonthCount' => $lastMonthTotal,
                'twoMonthsAgoCount' => $twoMonthsAgoTotal
            ]);
            $fareCollection->push($model);
        }
        return $fareCollection;
    }
}
