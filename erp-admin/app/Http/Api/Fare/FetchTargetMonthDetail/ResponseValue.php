<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\FetchTargetMonthDetail;

use App\Http\Api\Base\Connector\BaseResponseValue;
use Fare\Infrastructure\Port\Output\Response\FetchTargetMonthDetailResponse;

/**
 * 交通費詳細情報レスポンス
 * @property FetchTargetMonthDetailResponse $value
 * @method array toArray()
 */
final class ResponseValue extends BaseResponseValue
{
    /**
     * Store a new controller instance.
     *
     * @param FetchTargetMonthDetailResponse $response
     * @return void
     */
    public function __construct(
        FetchTargetMonthDetailResponse $response
    ){
        $this->value = $response;
    }
}
