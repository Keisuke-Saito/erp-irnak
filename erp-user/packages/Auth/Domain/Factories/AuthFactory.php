<?php
declare(strict_types=1);

namespace Auth\Domain\Factories;

use Auth\App\Port\InputAdapter;
use Auth\Domain\Models\Login\Values;
use Auth\Domain\Models\Login\LoginModel;
use Auth\Domain\Models\Login\GenerateApiToken;
use Auth\Domain\Models\Login\Uuid;

/**
 * 認証情報モデル生成
 * @property GenerateApiToken $token
 */
class AuthFactory
{
    /** @var GenerateApiToken 文字列関連 */
    private $token;

    /**
     * Store a new controller instance.
     *
     * @param GenerateApiToken $token
     * @return void
     */
    public function __construct(
        GenerateApiToken $token
    ){
        $this->token = $token;
    }

    /**
     * リクエスト情報から認証情報モデル生成
     *
     * @param InputAdapter $request
     * @return LoginModel
     */
    public function createFromRequest(InputAdapter $request): LoginModel
    {
        $list = $request->all();
        return new LoginModel(
            new Values\ErpId($list['erpId']),
            new Values\Password($list['password']),
            new Values\ApiToken($this->token)
        );
    }
}
