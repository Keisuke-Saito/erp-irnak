<?php
declare(strict_types=1);

namespace App\Http\Api\Auth\CheckCreateUserToken;

use App\Http\Api\Base\Connector\BaseResponseValue;
use Auth\Infrastructure\Port\Output\Response\CheckCreateUserTokenResponse;

/**
 * ワンタイムトークンチェックレスポンス
 * @property CheckCreateUserTokenResponse $value
 */
final class ResponseValue extends BaseResponseValue
{
    /**
     * Store a new controller instance.
     *
     * @param CheckCreateUserTokenResponse $chechOnetimeTokenResponse
     * @return void
     */
    public function __construct(
        CheckCreateUserTokenResponse $chechOnetimeTokenResponse
    ){
        $this->value = $chechOnetimeTokenResponse;
    }
}
