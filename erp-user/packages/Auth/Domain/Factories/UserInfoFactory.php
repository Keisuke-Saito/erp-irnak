<?php
declare(strict_types=1);

namespace Auth\Domain\Factories;

use Auth\App\Port\InputAdapter;
use Auth\Domain\Models\CreateUserInfo\Values;
use Auth\Domain\Models\CreateUserInfo\CreateUserInfoModel;
use Auth\Domain\Models\CreateUserInfo\GenerateApiToken;

/**
 * 認証情報モデル生成
 * @property GenerateApiToken $token
 */
class UserInfoFactory
{
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
     * リクエストからユーザー作成情報作成
     *
     * @param InputAdapter $request
     * @return CreateUserInfoModel
     */
    public function createFromRequest(InputAdapter $request): CreateUserInfoModel
    {
        $list = $request->all();
        return new CreateUserInfoModel(
            new Values\Token($list['token']),
            new Values\ErpId($list['erpId']),
            new Values\Email($list['email']),
            new Values\Password($list['password']),
            new Values\ApiToken($this->token)
        );
    }
}
