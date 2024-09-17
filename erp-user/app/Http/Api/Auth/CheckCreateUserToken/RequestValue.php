<?php
declare(strict_types=1);

namespace App\Http\Api\Auth\CheckCreateUserToken;

use App\Http\Api\Base\Connector\BaseRequestValue;

/**
 *ワンタイムトークンチェックリクエスト
 * @property string $token
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
    /** @var string ワンタイムトークン */
    protected $token;
    /**
     * Store a new controller instance.
     *
     * @param RequestValidation $request
     * @return void
     */
    public function __construct(
        RequestValidation $request
    ){
        $this->token = $request->token;
    }
}
