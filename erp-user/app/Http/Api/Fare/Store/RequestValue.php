<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\Store;

use App\Http\Api\Base\Connector\BaseRequestValue;
use Carbon\Carbon;

/**
 * 交通費登録リクエスト
 * @property string $erpId
 * @property array $detail
 * @property Carbon $targetMonth
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
    /** @var string 管理番号 */
    protected $erpId;
    /** @var array 交通費情報 */
    protected $detail;
    /** @var Carbon 対象月 */
    protected $targetMonth;
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
        $this->detail = $request->detail;
        $this->targetMonth = new Carbon($request->targetMonth);
    }
}
