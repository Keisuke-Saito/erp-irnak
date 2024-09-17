<?php
declare(strict_types=1);

namespace App\Http\Api\Auth\CreateUser;

use App\Http\Api\Base\Controller\Controller;
use Auth\App\Services\CreateUser;
use Auth\Infrastructure\Port\Input\Request\CreateUserRequest;
use Illuminate\Http\Response;

/**
 * ユーザー情報作成
 * @property CreateUser $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var CreateUser ユーザー情報作成 */
     private $service;
    /** @var Responder ユーザー情報作成レスポンス */
    private $responder;

    /**
     * Create a new controller instance.
     *
     * @param CreateUser $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        CreateUser $service,
        Responder $responder
    ) {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * ユーザー情報作成処理
     *
     * @param RequestValidation $request
     * @return Response
     */
    public function __invoke(RequestValidation $request): Response
    {
        $userInfo = $this->service->execute(new CreateUserRequest(new RequestValue($request)));
        return $this->responder
            ->setValue(new ResponseValue($userInfo))
            ->response();
    }
}
