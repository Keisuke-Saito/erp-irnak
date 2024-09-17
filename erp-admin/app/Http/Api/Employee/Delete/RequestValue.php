<?php
declare(strict_types=1);

namespace App\Http\Api\Employee\Delete;

use App\Http\Api\Base\Connector\BaseRequestValue;

/**
 * 従業員ログイン情報削除リクエスト
 * @property string $erpId
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
  protected $erpId;
    /**
     * Store a new controller instance.
     *
     * @param App\Http\Api\Employee\Delete\RequestValidation $request
     * @return void
     */
    public function __construct(
        RequestValidation $request
    ){
        $this->erpId = $request['erpId'];
    }
}
