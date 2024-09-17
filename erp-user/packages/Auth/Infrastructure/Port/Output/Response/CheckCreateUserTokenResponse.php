<?php
declare(strict_types=1);

namespace Auth\Infrastructure\Port\Output\Response;

use Auth\App\Port\OutputAdapter;
use Auth\App\Models\UserInfo;

/**
 * ワンタイムトークンチェックレスポンス
 * @property UserInfo $user
 */
final class CheckCreateUserTokenResponse implements OutputAdapter
{
    /** @var UserInfo ユーザー情報 */
    private $user;

    /**
     * Store a new controller instance.
     *
     * @param UserInfo $user
     * @return void
     */
    public function __construct(
        UserInfo $user
    ){
        $this->user = $user;
    }

    /**
     * ワンタイムトークンチェックレスポンス
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'erpId' => $this->user->getErpId(),
            'name' => $this->user->getName(),
            'email' => $this->user->getEmail()
        ];
    }
}
