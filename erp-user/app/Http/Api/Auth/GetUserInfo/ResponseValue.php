<?php
declare(strict_types=1);

namespace App\Http\Api\Auth\GetUserInfo;

use App\Http\Api\Base\Connector\BaseResponseValue;
use Auth\Infrastructure\Port\Output\Response\GetUserInfoResponse;

/**
 * ログインユーザー情報レスポンス
 * @property GetUserInfoResponse $value
 */
final class ResponseValue extends BaseResponseValue
{
    /**
     * Store a new controller instance.
     *
     * @param GetUserInfoResponse $getUserInfoResponse
     * @return void
     */
    public function __construct(
        GetUserInfoResponse $getUserInfoResponse
    ){
        $this->value = $getUserInfoResponse;
    }
}
