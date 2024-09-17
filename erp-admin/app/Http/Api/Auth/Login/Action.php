<?php
declare(strict_types=1);

namespace App\Http\Api\Auth\Login;

use App\Http\Api\Base\Controller\Controller;
use Auth\App\Services\Login;
use Auth\Infrastructure\Port\Input\Request\LoginRequest;
use Illuminate\Http\Response;

/**
 * ログイン
 * @property Login $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var Login ログイン */
     private $service;
    /** @var Responder ログインレスポンス */
    private $responder;

    /**
     * Create a new controller instance.
     *
     * @param Login $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        Login $service,
        Responder $responder
    ) {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * ログイン処理
     *
     * @param RequestValidation $request
     * @return Response
     */
    public function __invoke(RequestValidation $request): Response
    {
        $loginUser = $this->service->execute(new LoginRequest(new RequestValue($request)));
        return $this->responder
            ->setValue(new ResponseValue($loginUser))
            ->response();
    }
}
