<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\FetchTargetMonth;

use App\Http\Api\Base\Connector\BaseRequestValue;
use Carbon\Carbon;

/**
 * 交通費情報取得リクエスト
 * @property Carbon $target
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
    /** @var Carbon 交通費情報 */
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
        $this->target = new Carbon($request['target']);
    }
}
