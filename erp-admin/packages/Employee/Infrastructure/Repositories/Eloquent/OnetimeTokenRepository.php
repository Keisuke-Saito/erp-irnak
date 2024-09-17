<?php
declare(strict_types=1);

namespace Employee\Infrastructure\Repositories\Eloquent;

use App\Models\OnetimeToken;

use Employee\Domain\Repositories\OnetimeTokenRepositoryInterface;
use Employee\Infrastructure\Base\Model\BaseDomainModel;

/**
 * Eloquent ワンタイムトークンリポジトリ
 *
 * @property OnetimeTokenFactory $onetimeTokenFactory
 */
class OnetimeTokenRepository implements OnetimeTokenRepositoryInterface
{
    /**
     * DBにワンタイムトークンがすでに登録されているか
     *
     * @param BaseDomainModel $domainModel
     * @return bool
     */
    public function onetimeTokenExists(BaseDomainModel $domainModel): bool
    {
        return OnetimeToken::where('token', $domainModel->getToken()->getHashedValue())->exists();
    }

    /**
     * 新規ワンタイムトークン登録情報をDBへ登録
     *
     * @param BaseDomainModel $domainModel
     * @return void
     */
    public function createOnetimeToken(BaseDomainModel $domainModel)
    {
        $eloquentOnetimeToken = new OnetimeToken($domainModel->toOnetimeToken());
        $eloquentOnetimeToken->save();
    }
}
