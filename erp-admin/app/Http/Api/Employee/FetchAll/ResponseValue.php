<?php
declare(strict_types=1);

namespace App\Http\Api\Employee\FetchAll;

use App\Http\Api\Base\Connector\BaseResponseValue;
use Employee\Infrastructure\Port\Output\Response\FetchAllEmployeeResponse;

/**
 * 全従業員情報レスポンス
 * @property FetchAllEmployeeResponse $value
 */
final class ResponseValue extends BaseResponseValue
{
    /**
     * Store a new controller instance.
     *
     * @param FetchAllEmployeeResponse $response
     * @return void
     */
    public function __construct(
        FetchAllEmployeeResponse $response
    ){
        $this->value = $response;
    }
}
