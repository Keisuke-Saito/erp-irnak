<?php
declare(strict_types=1);

namespace Employee\Domain\Repositories;

use Employee\Infrastructure\Base\Model\BaseDomainModel;

/**
 * ワンタイムトークン情報処理
 */
interface OnetimeTokenRepositoryInterface
{
    /**
     * DBにワンタイムトークンがすでに登録されているか
     *
     * @param BaseDomainModel $domainModel
     * @return void
     */
    public function onetimeTokenExists(BaseDomainModel $domainModel);

    /**
     * ワンタイムトークン登録情報をDBへ登録
     *
     * @param BaseDomainModel $domainModel
     * @return void
     */
    public function createOnetimeToken(BaseDomainModel $domainModel);
}
