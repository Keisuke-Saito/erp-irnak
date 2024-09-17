<?php
declare(strict_types=1);

namespace App\Http\Api\Auth\Login;

use App\Http\Api\Base\Connector\BaseResponseValue;
use Auth\Infrastructure\Port\Output\Response\LoginResponse;

/**
 * ログイン情報レスポンス
 * @property LoginResponse $value
 */
final class ResponseValue extends BaseResponseValue
{
    /**
     * Store a new controller instance.
     *
     * @param LoginResponse $loginResponse
     * @return void
     */
    public function __construct(
        LoginResponse $loginResponse
    ){
        $this->value = $loginResponse;
    }
}
