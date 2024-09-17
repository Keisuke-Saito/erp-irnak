<?php
declare(strict_types=1);

namespace Auth\Domain\Models\Login;

use Auth\Infrastructure\Base\Model\BaseDomainModel;

/**
 * 認証情報モデル
 */
final class LoginModel extends BaseDomainModel
{
    protected $erpId;
    protected $passowrd;
    protected $apiToken;

    /**
     * Store a new controller instance.
     *
     * @param ErpId $erpId
     * @param Password $passowrd
     * @param ApiToken $apiToken
     * @return void
     */
    public function __construct(
        Values\ErpId $erpId,
        Values\Password $passowrd,
        Values\ApiToken $apiToken
    ){
        $this->erpId = $erpId;
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
            'erp_id' => $this->getErpId()->getValue(),
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
