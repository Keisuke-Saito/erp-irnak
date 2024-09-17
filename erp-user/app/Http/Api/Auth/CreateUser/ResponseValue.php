<?php
declare(strict_types=1);

namespace App\Http\Api\Auth\CreateUser;

use App\Http\Api\Base\Connector\BaseResponseValue;
use Auth\Infrastructure\Port\Output\Response\CreateUserResponse;

/**
 * ユーザー情報作成レスポンス
 * @property CreateUserResponse $value
 */
final class ResponseValue extends BaseResponseValue
{
    /**
     * Store a new controller instance.
     *
     * @param CreateUserResponse $getUserInfoResponse
     * @return void
     */
    public function __construct(
        CreateUserResponse $getUserInfoResponse
    ){
        $this->value = $getUserInfoResponse;
    }
}
