<?php
declare(strict_types=1);

namespace App\Http\Api\Employee\FetchProfileHistory;

use App\Http\Api\Base\Connector\BaseRequestValue;
use Carbon\Carbon;

/**
 * ユーザー別情報履歴取得リクエスト
 * @property string $erpId
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
    /** @var string 従業員ID */
    protected $erpId;

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
    }
}
