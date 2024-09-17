<?php
declare(strict_types=1);

namespace Auth\App\Services;

use Auth\App\Port\InputAdapter;
use Auth\Domain\Availability\Authenticatable;
use Auth\Domain\Repositories\LoginRepositoryInterface;
use Auth\Infrastructure\Exceptions\UnauthorizedException;
use Auth\Infrastructure\Port\Output\Response\LoginResponse;

/**
 * ログイン
 * @property Authenticatable $auth
 * @property LoginRepositoryInterface $loginRepository
 */
final class Login
{
    /** @var Authenticatable 認証 */
    private $auth;
    /** @var LoginRepositoryInterface 認証情報接続 */
    private $loginRepository;

    /**
     * Store a new controller instance.
     *
     * @param Authenticatable $auth
     * @param LoginRepositoryInterface $loginRepository
     * @return void
     */
    public function __construct(
        Authenticatable $auth,
        LoginRepositoryInterface $loginRepository
    ){
        $this->auth = $auth;
        $this->loginRepository = $loginRepository;
    }

    /**
     * ログイン
     *
     * @param InputAdapter $request
     * @return LoginResponse
     * @throws UnauthorizedException
     */
    public function execute(InputAdapter $request)
    {
        $loginUser = $this->loginRepository->loginUser($request);
        $this->auth->attempt($loginUser);
        $this->loginRepository->setApiToken($loginUser);
        return new LoginResponse($loginUser);
    }
}
