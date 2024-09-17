<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\ShowHistory;

use App\Http\Api\Base\Connector\BaseResponseValue;
use Fare\Infrastructure\Port\Output\Response\ShowHistoryResponse;

/**
 * 交通費履歴情報レスポンス
 * @property ShowHistoryResponse $value
 * @method array toArray()
 */
final class ResponseValue extends BaseResponseValue
{
    /**
     * Store a new controller instance.
     *
     * @param ShowHistoryResponse $response
     * @return void
     */
    public function __construct(
        ShowHistoryResponse $response
    ){
        $this->value = $response;
    }
}
