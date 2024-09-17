<?php
declare(strict_types=1);

namespace Auth\App\Services;

use Auth\App\Port\InputAdapter;
use Auth\App\QueryServices\OnetimeTokenQueryInterface;
use Auth\Infrastructure\Exceptions\NotFoundException;
use Auth\Infrastructure\Port\Output\Response\CheckCreateUserTokenResponse;

/**
 * ワンタイムトークンチェック
 * @property OnetimeTokenQueryInterface $onetimeTokenQuery
 */
final class CheckCreateUserToken
{
    /** @var OnetimeTokenQueryInterface ワンタイムトークン情報接続 */
    private $onetimeTokenQuery;

    /**
     * Store a new controller instance.
     *
     * @param OnetimeTokenQueryInterface $onetimeTokenQuery
     * @return void
     */
    public function __construct(
        OnetimeTokenQueryInterface $onetimeTokenQuery
    ){
        $this->onetimeTokenQuery = $onetimeTokenQuery;
    }

    /**
     * ワンタイムトークンチェック
     *
     * @param InputAdapter $request
     * @return LoginResponse
     * @throws NotFoundException
     */
    public function execute(InputAdapter $request)
    {
        $userInfo = $this->onetimeTokenQuery->getUserInfoFromCreateUserToken($request);
        return new CheckCreateUserTokenResponse($userInfo);
    }
}
