<?php
declare(strict_types=1);

namespace App\Http\Api\Employee\FetchProfileDetail;

use App\Http\Api\Base\Connector\BaseRequestValue;

/**
 * 従業員詳細情報取得リクエスト
 * @property string $uuid
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
    /** @var string uuid */
    protected $uuid;

    /**
     * Store a new controller instance.
     *
     * @param RequestValidation $request
     * @return void
     */
    public function __construct(
        RequestValidation $request
    ){
        $this->uuid = $request['uuid'];
    }
}
