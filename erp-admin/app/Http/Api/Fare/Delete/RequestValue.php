<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\Delete;

use App\Http\Api\Base\Connector\BaseRequestValue;

/**
 * 交通費削除リクエスト
 * @property string $uuid
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
    /** @var string ID */
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
        $this->uuid = $request->uuid;
    }
}
