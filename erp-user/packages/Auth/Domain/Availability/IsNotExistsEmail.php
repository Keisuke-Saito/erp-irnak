<?php
declare(strict_types=1);

namespace Auth\Domain\Availability;

use Auth\Infrastructure\Exceptions\ValidationException;
use Auth\Domain\Models\CreateUserInfo\CreateUserInfoModel;
use Auth\Domain\Repositories\UserInfoRepositoryInterface;

/**
 * メールアドレスがまだ登録されていないかチェック
 * @property UserInfoRepositoryInterface $userInfoRepository
 */
final class IsNotExistsEmail
{
    /** @var UserInfoRepositoryInterface ワンタイムトークン情報接続 */
    private $userInfoRepository;
    /** @var string エラーメッセージ */
    private const UNAUTHORIZED = 'このメールアドレスは既に登録されています。';

    /**
     * Store a new controller instance.
     *
     * @param UserInfoRepositoryInterface $userInfoRepository
     * @return void
     */
    public function __construct(
        UserInfoRepositoryInterface $userInfoRepository
    ){
        $this->userInfoRepository = $userInfoRepository;
    }

    /**
     * メールアドレスがまだ登録されていないかチェック
     *
     * @param CreateUserInfoModel $user
     * @return void
     * @throws ValidationException
     */
    public function isNotExistsEmail(CreateUserInfoModel $user): void
    {
        if ($this->userInfoRepository->emailNotExists($user)) return;

        throw new ValidationException(self::UNAUTHORIZED);
    }
}
