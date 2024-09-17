<?php
declare(strict_types=1);

namespace Auth\Infrastructure\Repositories\Eloquent;

use App\Models\Admin;

use Auth\App\Port\InputAdapter;
use Auth\Domain\Models\Login\LoginModel;
use Auth\Domain\Factories\AuthFactory;
use Auth\Domain\Repositories\LoginRepositoryInterface;

/**
 * Eloquent 認証情報リポジトリ
 * @property AuthFactory $authFactory
 */
class LoginRepository implements LoginRepositoryInterface
{
    /** @var AuthFactory 認証情報モデル生成 */
    private $authFactory;

    /**
     * Store a new controller instance.
     *
     * @param AuthFactory $authFactory
     * @return void
     */
    public function __construct(
        AuthFactory $authFactory
    ){
        $this->authFactory = $authFactory;
    }

    /**
     * 新規認証情報モデル生成
     *
     * @param InputAdapter $request
     * @return LoginModel
     */
    public function loginUser(InputAdapter $request): LoginModel
    {
        return $this->authFactory->createFromRequest($request);
    }

    /**
     * 認証
     *
     * @param LoginModel $loginUser
     * @return bool
     */
    public function attempt(LoginModel $loginUser): bool
    {
        return \Auth::attempt($loginUser->credentials());
    }

    /**
     * ログインユーザーにAPIトークンをセット
     * トークンはコンフィグで指定された方法でハッシュ化される
     *
     * @param LoginModel $loginUser
     * @return void
     */
    public function setApiToken(LoginModel $loginUser): void
    {
        $admin = \Auth::user();
        $admin->api_token = $loginUser->getApiToken()->getHashedValue();
        $admin->save();
    }
}
