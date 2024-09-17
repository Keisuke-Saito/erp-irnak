<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\FetchTargetMonthDetail;

use App\Http\Api\Base\Connector\BaseRequestValue;
use Carbon\Carbon;

/**
 * 交通費詳細情報取得リクエスト
 * @property string $erpId
 * @property Carbon $target
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
    /** @var string 交通費詳細情報 */
    protected $erpId;
    /** @var Carbon 交通費詳細情報 */
    protected $target;

    /**
     * Store a new controller instance.
     *
     * @param RequestValidation $request
     * @return void
     */
    public function __construct(
        RequestValidation $request
    ){
        $this->erpId = $request['erpId'];
        $this->target = new Carbon($request['target']);
    }
}
