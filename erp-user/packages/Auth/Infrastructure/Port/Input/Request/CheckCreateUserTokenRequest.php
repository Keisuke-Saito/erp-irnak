<?php
declare(strict_types=1);

namespace Auth\Infrastructure\Port\Input\Request;

use App\Http\Api\Base\Connector\BaseRequestValue;
use Auth\App\Port\InputAdapter;

/**
 * リクエストラッパー
 * @property BaseRequestValue $requestValue
 */
final class CheckCreateUserTokenRequest implements InputAdapter
{
    /** @var BaseRequestValue リクエストバリュー */
    private $requestValue;

    /**
     * Store a new controller instance.
     *
     * @param BaseRequestValue $request
     * @return void
     */
    public function __construct(
        BaseRequestValue $requestValue
    ){
        $this->requestValue = $requestValue;
    }

    /**
     * リクエスト全権取得
     *
     * @return array
     */
    public function all(): array
    {
        return $this->requestValue->toArray();
    }
}
