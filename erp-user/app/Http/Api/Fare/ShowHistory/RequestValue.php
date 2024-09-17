<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\ShowHistory;

use App\Http\Api\Base\Connector\BaseRequestValue;
use Carbon\Carbon;

/**
 * 履歴情報取得リクエスト
 * @property string $erpId
 * @property Carbon $target
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
    /** @var string 管理番号 */
    protected $erpId;
    /** @var Carbon 対象月 */
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
        $this->erpId = $request->user()->erp_id;
        $this->target = new Carbon($request['target']);
    }
}
