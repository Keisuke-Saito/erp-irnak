<?php
declare(strict_types=1);

namespace App\Http\Api\Employee\FetchProfileDetail;

use App\Http\Api\Base\Connector\BaseResponseValue;
use Employee\Infrastructure\Port\Output\Response\FetchProfileDetailResponse;

/**
 * 従業員詳細情報取得レスポンス
 * @property FetchProfileDetailResponse $value
 * @method array toArray()
 */
final class ResponseValue extends BaseResponseValue
{
    /**
     * Store a new controller instance.
     *
     * @param FetchProfileDetailResponse $response
     * @return void
     */
    public function __construct(
        FetchProfileDetailResponse $response
    ){
        $this->value = $response;
    }
}
