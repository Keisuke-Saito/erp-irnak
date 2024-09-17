<?php
declare(strict_types=1);

namespace App\Http\Api\Auth\GetUserInfo;

use App\Http\Api\Base\Controller\Controller;
use Auth\App\Services\GetUserInfo;
use Auth\Infrastructure\Port\Input\Request\GetUserInfoRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * ユーザー情報取得
 * @property GetUserInfo $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var GetUserInfo ユーザー情報 */
     private $service;
    /** @var Responder ユーザー情報レスポンス */
    private $responder;

    /**
     * Create a new controller instance.
     *
     * @param GetUserInfo $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        GetUserInfo $service,
        Responder $responder
    ) {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * ユーザー情報取得処理
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $userInfo = $this->service->execute(new GetUserInfoRequest(new RequestValue($request->user())));
        return $this->responder
            ->setValue(new ResponseValue($userInfo))
            ->response();
    }
}
