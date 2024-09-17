<?php
declare(strict_types=1);

namespace Auth\App\Services;

use Auth\App\Port\InputAdapter;
use Auth\App\QueryServices\UserInfoQueryInterface;
use Auth\Infrastructure\Port\Output\Response\GetUserInfoResponse;

/**
 * ユーザー情報取得
 * @property UserInfoQueryInterface $userInfoQuery
 */
final class GetUserInfo
{
    /** @var UserInfoQueryInterface ユーザー情報接続 */
    private $userInfoQuery;

    /**
     * Store a new controller instance.
     *
     * @param UserInfoQueryInterface $userInfoQuery
     * @return void
     */
    public function __construct(
        UserInfoQueryInterface $userInfoQuery
    ){
        $this->userInfoQuery = $userInfoQuery;
    }

    /**
     * ユーザー情報取得
     *
     * @param InputAdapter $request
     * @return GetUserInfoResponse
     */
    public function execute(InputAdapter $request)
    {
        $userInfo = $this->userInfoQuery->findFromRequestByErpId($request);
        return new GetUserInfoResponse($userInfo);
    }
}
