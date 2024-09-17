<?php
declare(strict_types=1);

namespace Auth\Infrastructure\Query\Eloquent;

use App\Models as DBA;

use Auth\App\Models\UserInfo;
use Auth\App\Port\InputAdapter;
use Auth\App\QueryServices\OnetimeTokenQueryInterface;
use Auth\Infrastructure\Exceptions\NotFoundException;

/**
 * ワンタイムトークン情報取得に必要な処理
 */
final class OnetimeTokenQuery implements OnetimeTokenQueryInterface
{
    /** @var int トークンタイプ・ユーザー作成 */
    const CREATE_USER = 1;

    /**
     * DBにユーザー登録用ワンタイムトークンが登録されているか
     *
     * @param InputAdapter $request
     * @return UserInfo
     * @throws NotFoundException
     */
    public function getUserInfoFromCreateUserToken(InputAdapter $request): UserInfo
    {
        $param = $request->all();
        $onetimeToken = DBA\OnetimeToken::where([
            ['token', hash('sha256', $param['token'])],
            ['type_div', self::CREATE_USER]
        ])->first();
        if (is_null($onetimeToken)) throw new NotFoundException('トークンが設定されていません');
        $profile = $onetimeToken->profile;
        if (is_null($profile)) throw new NotFoundException('有効なユーザーが登録されていません');
        $model = new UserInfo();
        $model->fill($profile->toArray());
        return $model;
    }
}
