<?php
declare(strict_types=1);

namespace App\Http\Api\Employee\CsvDownloadExample;

use App\Http\Api\Base\Connector\BaseResponseValue;
use Employee\Infrastructure\Port\Output\Response\CsvResponse;

/**
 * CSV情報レスポンス
 * @property CsvResponse $value
 * @method array toArray()
 */
final class ResponseValue extends BaseResponseValue
{
    /**
     * Store a new controller instance.
     *
     * @param CsvResponse $response
     * @return void
     */
    public function __construct(
        CsvResponse $response
    ){
        $this->value = $response;
    }
}
