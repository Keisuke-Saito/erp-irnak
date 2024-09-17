<?php
declare(strict_types=1);

namespace App\Http\Api\Common\FetchCommonMst;

use App\Http\Api\Base\Connector\BaseResponseValue;
use Common\Infrastructure\Port\Output\Response\FetchCommonMstResponse;

/**
 * 一般マスタ情報レスポンス
 * @property FetchCommonMstResponse $value
 */
final class ResponseValue extends BaseResponseValue
{
    /**
     * Store a new controller instance.
     *
     * @param FetchCommonMstResponse $response
     * @return void
     */
    public function __construct(
        FetchCommonMstResponse $response
    ){
        $this->value = $response;
    }
}
