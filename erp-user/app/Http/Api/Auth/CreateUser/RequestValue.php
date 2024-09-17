<?php
declare(strict_types=1);

namespace App\Http\Api\Auth\CreateUser;

use App\Http\Api\Base\Connector\BaseRequestValue;
use App\Models\User;

/**
 * ユーザー情報作成リクエスト
 * @property string $token
 * @property string $erpId
 * @property string $email
 * @property string $password
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
    /** @var string トークン */
    protected $token;
    /** @var string 管理番号 */
    protected $erpId;
    /** @var string メールアドレス */
    protected $email;
    /** @var string パスワード */
    protected $password;
    /**
     * Store a new controller instance.
     *
     * @param RequestValidation $request
     * @return void
     */
    public function __construct(
        RequestValidation $request
    ){
        $list = $request->all();
        $this->token = $list['token'];
        $this->erpId = $list['erpId'];
        $this->email = $list['email'];
        $this->password = $list['password'];
    }
}
