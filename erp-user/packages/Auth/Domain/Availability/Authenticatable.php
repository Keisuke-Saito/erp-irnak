<?php
declare(strict_types=1);

namespace Auth\Domain\Availability;

use Auth\Infrastructure\Exceptions\UnauthorizedException;
use Auth\Domain\Models\Login\LoginModel;
use Auth\Domain\Repositories\LoginRepositoryInterface;

/**
 * 認証
 * @property LoginRepositoryInterface $loginRepository
 */
final class Authenticatable
{
    /** @var LoginRepositoryInterface 認証情報接続 */
    private $loginRepository;
    /** @var string エラーメッセージ */
    private const UNAUTHORIZED = 'ログイン認証に失敗しました。アカウント情報を再度確認いただくか、システム管理者に問い合わせをしてください';

    /**
     * Store a new controller instance.
     *
     * @param LoginRepositoryInterface $loginRepository
     * @return void
     */
    public function __construct(
        LoginRepositoryInterface $loginRepository
    ){
        $this->loginRepository = $loginRepository;
    }

    /**
     * 認証処理
     * 認証に失敗した場合はexception
     *
     * @param LoginModel $loginUser
     * @return void
     * @throws UnauthorizedException
     */
    public function attempt(LoginModel $loginUser): void
    {
        if ($this->loginRepository->attempt($loginUser)) return;

        throw new UnauthorizedException(self::UNAUTHORIZED);
    }
}
