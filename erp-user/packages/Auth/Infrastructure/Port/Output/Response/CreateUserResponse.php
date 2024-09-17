<?php
declare(strict_types=1);

namespace Auth\Infrastructure\Port\Output\Response;

use Auth\App\Port\OutputAdapter;
use Auth\Domain\Models\CreateUserInfo\CreateUserInfoModel;

/**
 * ユーザー作成レスポンス
 * @property CreateUserInfoModel|null $user
 */
final class CreateUserResponse implements OutputAdapter
{
    /** @var CreateUserInfoModel ユーザー情報 */
    private $user;

    /**
     * Store a new controller instance.
     *
     * @param CreateUserInfoModel $user
     * @return void
     */
    public function __construct(
        CreateUserInfoModel $user
    ){
        $this->user = $user;
    }

    /**
     * ユーザー作成レスポンス
     *
     * @return array
     */
    public function toArray(): array
    {
        return ['token' => $this->user->getApiToken()->getValue()];
    }
}
