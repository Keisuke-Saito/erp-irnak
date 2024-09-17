<?php
declare(strict_types=1);

namespace Fare\Domain\Factories;

use Fare\App\Port\InputAdapter;
use Fare\Domain\Models\UpdateDetail\Values as UpdateDetailValues;
use Fare\Domain\Models\UpdateDetail\UpdateDetailModel;
use Fare\Domain\Models\DeleteDetail\Values as DeleteDetailValues;
use Fare\Domain\Models\DeleteDetail\DeleteDetailModel;

use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

/**
 * 交通費詳細情報モデル生成
 * @property GenerateApiToken $token
 */
class FareDetailFactory
{
    /**
     * リクエスト情報から交通費詳細更新情報モデル生成
     *
     * @param InputAdapter $request
     * @return UpdateDetailModel
     */
    public function createUpdateModelFromRequest(InputAdapter $request): UpdateDetailModel
    {
        $list = $request->all();
        Log::debug($list);
        return new UpdateDetailModel(
            new UpdateDetailValues\Uuid($list['uuid']),
            new UpdateDetailValues\FareId($list['fareId']),
            new UpdateDetailValues\TargetDate($list['targetDate']),
            new UpdateDetailValues\Destination($list['destination']),
            new UpdateDetailValues\PointOfDeparture($list['pointOfDeparture']),
            new UpdateDetailValues\Arrival($list['arrival']),
            new UpdateDetailValues\RouteDiv($list['routeDiv']),
            new UpdateDetailValues\Transportation($list['transportation']),
            new UpdateDetailValues\AmountOfMoney($list['amountOfMoney']),
            new UpdateDetailValues\AdminRemarks($list['adminRemarks']),
            new UpdateDetailValues\Receipt($list['receipt']),
            new UpdateDetailValues\ImgObj($list['imgObj']),
            new UpdateDetailValues\Disk()
        );
    }
    /**
     * リクエスト情報から交通費詳細削除情報モデル生成
     *
     * @param InputAdapter $request
     * @return DeleteDetailModel
     */
    public function createDeleteModelFromRequest(InputAdapter $request): DeleteDetailModel
    {
        $list = $request->all();
        return new DeleteDetailModel(
            new DeleteDetailValues\Uuid($list['uuid']),
            new DeleteDetailValues\Disk()
        );
    }
}
