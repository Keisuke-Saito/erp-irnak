<?php
declare(strict_types=1);

namespace Auth\Infrastructure\Port\Output\Response;

use Auth\App\Port\OutputAdapter;
use Auth\Domain\Models\Login\LoginModel;

/**
 * ログイン情報レスポンス
 * @property LoginModel $loginUser
 */
final class LoginResponse implements OutputAdapter
{
    /** @var LoginModel ログイン情報 */
    private $loginUser;

    /**
     * Store a new controller instance.
     *
     * @param LoginModel $loginUser
     * @return void
     */
    public function __construct(
        LoginModel $loginUser
    ){
        $this->loginUser = $loginUser;
    }

    /**
     * ログイン情報取得
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->loginUser->toArray();
    }
}
