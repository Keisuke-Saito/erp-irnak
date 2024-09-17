<?php
declare(strict_types=1);

namespace Auth\Domain\Models\Login;

use Auth\Infrastructure\Base\Model\BaseDomainModel;

/**
 * 認証情報モデル
 */
final class LoginModel extends BaseDomainModel
{
    protected $loginId;
    protected $passowrd;
    protected $apiToken;

    /**
     * Store a new controller instance.
     *
     * @param LoginId $loginId
     * @param Password $passowrd
     * @param ApiToken $apiToken
     * @return void
     */
    public function __construct(
        Values\LoginId $loginId,
        Values\Password $passowrd,
        Values\ApiToken $apiToken
    ){
        $this->loginId = $loginId;
        $this->passowrd = $passowrd;
        $this->apiToken = $apiToken;
    }

    /**
     * 認証用
     *
     * @return array
     */
    public function credentials(): array
    {
        return [
            config('app.USERNAME.COLUMN') => $this->getLoginId()->getValue(),
            'password' => $this->getPassowrd()->getValue()
        ];
    }

    /**
     * レスポンス用
     *
     * @return array
     */
    public function toArray(): array
    {
        return ['token' => $this->getApiToken()->getValue()];
    }
}
