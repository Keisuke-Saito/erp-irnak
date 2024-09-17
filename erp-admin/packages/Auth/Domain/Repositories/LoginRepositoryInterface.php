<?php
declare(strict_types=1);

namespace Auth\Domain\Repositories;

use Auth\App\Port\InputAdapter;
use Auth\Domain\Models\Login\LoginModel;

/**
 * 社員登録情報取得に必要な処理
 */
interface LoginRepositoryInterface
{
    public function loginUser(InputAdapter $request): LoginModel;
    public function attempt(LoginModel $loginUser): bool;
    public function setApiToken(LoginModel $loginUser): void;
}
