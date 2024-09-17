<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\FetchTargetMonth;

use App\Http\Api\Base\Connector\BaseResponseValue;
use Fare\Infrastructure\Port\Output\Response\FetchTargetMonthResponse;

/**
 * 交通費情報レスポンス
 * @property FetchTargetMonthResponse $value
 * @method array toArray()
 */
final class ResponseValue extends BaseResponseValue
{
    /**
     * Store a new controller instance.
     *
     * @param FetchTargetMonthResponse $response
     * @return void
     */
    public function __construct(
        FetchTargetMonthResponse $response
    ){
        $this->value = $response;
    }
}
