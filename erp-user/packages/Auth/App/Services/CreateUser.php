<?php
declare(strict_types=1);

namespace Auth\App\Services;

use Auth\App\Port\InputAdapter;
use Auth\Domain\Availability\IsExistsToken;
use Auth\Domain\Availability\IsNotExistsEmail;
use Auth\Domain\Repositories\UserInfoRepositoryInterface;
use Auth\Infrastructure\Exceptions\UnauthorizedException;
use Auth\Infrastructure\Exceptions\ValidationException;
use Auth\Infrastructure\Port\Output\Response\CreateUserResponse;

/**
 * ユーザー情報作成
 * @property UserInfoRepositoryInterface $userInfoRepository
 * @property IsExistsToken $isExistsToken
 * @property IsNotExistsEmail $isNotExistsEmail
 */
final class CreateUser
{
    /** @var UserInfoRepositoryInterface ユーザー情報接続 */
    private $userInfoRepository;
    /** @var IsExistsToken ワンタイムトークンが登録されているかチェック */
    private $isExistsToken;
    /** @var IsNotExistsEmail メールアドレスがまだ登録されていないかチェック */
    private $isNotExistsEmail;

    /**
     * Store a new controller instance.
     *
     * @param UserInfoRepositoryInterface $userInfoRepository
     * @param IsExistsToken $isExistsToken
     * @param IsNotExistsEmail $isNotExistsEmail
     * @return void
     */
    public function __construct(
        UserInfoRepositoryInterface $userInfoRepository,
        IsExistsToken $isExistsToken,
        IsNotExistsEmail $isNotExistsEmail
    ){
        $this->userInfoRepository = $userInfoRepository;
        $this->isExistsToken = $isExistsToken;
        $this->isNotExistsEmail = $isNotExistsEmail;
    }

    /**
     * ユーザー情報作成
     *
     * @param InputAdapter $request
     * @return CreateUserResponse
     * @throws UnauthorizedException
     * @throws ValidationException
     */
    public function execute(InputAdapter $request)
    {
        // ユーザー作成情報作成
        $user = $this->userInfoRepository->newCreateUserInfoModel($request);
        // ワンタイムトークンが登録されているかチェック
        $this->isExistsToken->isExistsToken($user);
        // メールアドレスがまだ登録されていないかチェック
        $this->isNotExistsEmail->isNotExistsEmail($user);
        // ユーザー情報登録
        $this->userInfoRepository->createUserInfo($user);

        return new CreateUserResponse($user);
    }
}
