<?php
declare(strict_types=1);

namespace App\Http\Api\Auth\Login;

use App\Http\Api\Base\Connector\BaseRequestValue;

/**
 * ログインリクエスト
 * @property string $loginId
 * @property string $password
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
    /** @var string ログインID */
    protected $loginId;
    /** @var string パスワード */
    protected $password;
    /**
     * Store a new controller instance.
     *
     * @param App\Http\Api\Auth\Login\RequestValidation $request
     * @return void
     */
    public function __construct(
        RequestValidation $request
    ){
        $this->loginId = $request->username;
        $this->password = $request->password;
    }
}
