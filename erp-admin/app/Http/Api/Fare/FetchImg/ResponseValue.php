<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\FetchImg;

use App\Http\Api\Base\Connector\BaseResponseValue;
use Common\Infrastructure\Port\Output\Response\FetchImgResponse;

/**
 * 領収書画像情報レスポンス
 * @property FetchImgResponse $value
 * @method array toArray()
 */
final class ResponseValue extends BaseResponseValue
{
    /**
     * Store a new controller instance.
     *
     * @param FetchImgResponse $response
     * @return void
     */
    public function __construct(
        FetchImgResponse $response
    ){
        $this->value = $response;
    }
}
