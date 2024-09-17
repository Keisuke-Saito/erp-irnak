<?php
declare(strict_types=1);

namespace Auth\Infrastructure\Repositories\Eloquent;

use App\Models as DBA;

use Auth\Domain\Models\CreateUserInfo\CreateUserInfoModel;
use Auth\Domain\Repositories\OnetimeTokenRepositoryInterface;

/**
 * Eloquent ワンタイムトークン情報リポジトリ
 * @property AuthFactory $authFactory
 */
class OnetimeTokenRepository implements OnetimeTokenRepositoryInterface
{
    /**
     * ワンタイムトークンが登録されているか
     *
     * @param CreateUserInfoModel $user
     * @return bool
     */
    public function isExistsToken(CreateUserInfoModel $user): bool
    {
        $list = $user->toOnetimeToken();
        return DBA\OnetimeToken::where([
            ['token', $list['token']],
            ['type_div', $list['type_div']]
        ])->exists();
    }
}
