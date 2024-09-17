<?php
declare(strict_types=1);

namespace Employee\Infrastructure\Port\Input\Request;

use App\Http\Api\Base\Connector\BaseRequestValue;
use Employee\App\Port\InputAdapter;

/**
 * リクエストラッパー
 * @property BaseRequestValue $requestValue
 */
final class FetchProfileDetailRequest implements InputAdapter
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
     * リクエスト取得
     *
     * @param string $name
     * @return mixed
     */
    public function get(string $name)
    {
        return $this->requestValue->toArray()[$name];
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
