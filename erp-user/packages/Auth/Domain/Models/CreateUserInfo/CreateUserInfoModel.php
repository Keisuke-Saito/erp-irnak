<?php
declare(strict_types=1);

namespace Auth\Domain\Models\CreateUserInfo;

use Auth\Infrastructure\Base\Model\BaseDomainModel;

/**
 * ユーザー情報作成モデル
 */
final class CreateUserInfoModel extends BaseDomainModel
{
    /** @var Token ワンタイムトークン */
    protected $apiToken;
    /** @var ErpId 管理番号 */
    protected $erpId;
    /** @var Email メールアドレス */
    protected $email;
    /** @var Password パスワード */
    protected $passowrd;

    /**
     * Store a new controller instance.
     *
     * @param Token $token
     * @param ErpId $erpId
     * @param Email $id
     * @param Password $passowrd
     * @param ApiToken $apiToken
     * @return void
     */
    public function __construct(
        Values\Token $token,
        Values\ErpId $erpId,
        Values\Email $email,
        Values\Password $passowrd,
        Values\ApiToken $apiToken
    ){
        $this->token = $token;
        $this->erpId = $erpId;
        $this->email = $email;
        $this->passowrd = $passowrd;
        $this->apiToken = $apiToken;
    }

    /**
     * ユーザー用
     *
     * @return array
     */
    public function toUser(): array
    {
        return [
            'erp_id' => $this->erpId->getValue(),
            'hash_email' => $this->email->getHashedValue(),
            'password' => $this->passowrd->getHashedValue(),
            'api_token' => $this->apiToken->getHashedValue()
        ];
    }

    /**
     * ワンタイムトークン用
     *
     * @return array
     */
    public function toOnetimeToken(): array
    {
        return [
            'token' => $this->token->getHashedValue(),
            'type_div' => $this->token->getTypeDiv()
        ];
    }
}
