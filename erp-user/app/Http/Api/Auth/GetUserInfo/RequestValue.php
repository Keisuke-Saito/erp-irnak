<?php
declare(strict_types=1);

namespace App\Http\Api\Auth\GetUserInfo;

use App\Http\Api\Base\Connector\BaseRequestValue;
use App\Models\User;

/**
 * ユーザー情報取得リクエスト
 * @property string $erpId
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
    /** @var string 管理番号 */
    protected $erpId;
    /**
     * Store a new controller instance.
     *
     * @param User $user
     * @return void
     */
    public function __construct(
        User $user
    ){
        $this->erpId = $user->erp_id;
    }
}
