<?php
declare(strict_types=1);

namespace Employee\Domain\Availability;

use Employee\Domain\Repositories\OnetimeTokenRepositoryInterface;
use Employee\Infrastructure\Base\Model\BaseDomainModel;
use Employee\Infrastructure\Exceptions\ConflictException;

/**
 * ワンタイムトークンの一意性確認
 * @property OnetimeTokenRepositoryInterface $onetimeTokenRepository
 * @property string ERROR
 */
final class UniqOnetimeToken
{
    /** @var OnetimeTokenRepositoryInterface ワンタイムトークン情報接続 */
    private $onetimeTokenRepository;
    /** @var string エラーメッセージ */
    private const ERROR = '既に登録されているワンタイムトークンです。';

    /**
     * Store a new controller instance.
     *
     * @param OnetimeTokenRepositoryInterface $onetimeTokenRepository
     * @return void
     */
    public function __construct(
        OnetimeTokenRepositoryInterface $onetimeTokenRepository
    ){
        $this->onetimeTokenRepository = $onetimeTokenRepository;
    }

    /**
     * ワンタイムトークンの一意性確認
     *
     * @param BaseDomainModel $domainModel
     * @return void
     * @throws ConflictException
     */
    public function isUniqOnetimeToken(BaseDomainModel $domainModel)
    {
        if ($this->onetimeTokenRepository->onetimeTokenExists($domainModel)) throw new ConflictException(self::ERROR);
    }
}
