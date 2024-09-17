<?php
declare(strict_types=1);

namespace App\Http\Api\Employee\FetchProfileHistory;

use App\Http\Api\Base\Connector\BaseResponseValue;
use Employee\Infrastructure\Port\Output\Response\FetchProfileHistoryResponse;

/**
 * ユーザー別情報履歴取得レスポンス
 * @property FetchProfileHistoryResponse $value
 * @method array toArray()
 */
final class ResponseValue extends BaseResponseValue
{
    /**
     * Store a new controller instance.
     *
     * @param FetchProfileHistoryResponse $response
     * @return void
     */
    public function __construct(
        FetchProfileHistoryResponse $response
    ){
        $this->value = $response;
    }
}
