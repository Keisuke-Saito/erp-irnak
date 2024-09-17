<?php
declare(strict_types=1);

namespace Auth\Domain\Availability;

use Auth\Infrastructure\Exceptions\UnauthorizedException;
use Auth\Domain\Models\CreateUserInfo\CreateUserInfoModel;
use Auth\Domain\Repositories\OnetimeTokenRepositoryInterface;

/**
 * ワンタイムトークンが登録されているかチェック
 * @property OnetimeTokenRepositoryInterface $onetimeTokenRepository
 */
final class IsExistsToken
{
    /** @var OnetimeTokenRepositoryInterface ワンタイムトークン情報接続 */
    private $onetimeTokenRepository;
    /** @var string エラーメッセージ */
    private const UNAUTHORIZED = '無効なトークンです。';

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
     * ワンタイムトークンが登録されているかチェック
     *
     * @param CreateUserInfoModel $user
     * @return void
     * @throws UnauthorizedException
     */
    public function isExistsToken(CreateUserInfoModel $user): void
    {
        if ($this->onetimeTokenRepository->isExistsToken($user)) return;

        throw new UnauthorizedException(self::UNAUTHORIZED);
    }
}
