<?php
declare(strict_types=1);

namespace Fare\Infrastructure\Query\Eloquent;

use App\Models as DBA;

use Illuminate\Support\Collection as LaravelCollection;

use Fare\App\Models\UserInfo;
use Fare\App\Models\Fare;
use Fare\App\Models\FareDetail;
use Fare\App\Collections\FareDetailCollection;
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
     * @param UserInfo $userInfo
     * @return FareDetailCollection
     */
    public function getDetailByTargetMonth(
        InputAdapter $request,
        UserInfo $userInfo
    ): FareDetailCollection {
        $fareDetailCollection = new FareDetailCollection();
        $fareDetailCollection->setTarget($request->get('target'));
        $target = $fareDetailCollection->getTarget();

        $eloquentFare = DBA\Fare::firstOrNew([
            'erp_id' => $userInfo->getErpId(),
            'target_month' => $target
        ], [
            'confirm_status' => null
        ]);

        $eloquentFareDetails = $eloquentFare->fareDetail()->orderBy('target_date', 'asc')->get();

        $fare = new Fare();
        $fare->fill($eloquentFare->toArray());
        $fareDetailCollection->setFare($fare);

        foreach ($eloquentFareDetails as $eloquentFareDetail) {
            $fareDetail = new FareDetail();
            $fareDetail->fill($eloquentFareDetail->toArray());
            $fareDetailCollection->push($fareDetail);
        }

        return $fareDetailCollection;
    }
}
