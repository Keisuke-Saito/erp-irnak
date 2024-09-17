<?php
declare(strict_types=1);

namespace App\Http\Api\Auth\CheckCreateUserToken;

use App\Http\Api\Base\Controller\Controller;
use Auth\App\Services\CheckCreateUserToken;
use Auth\Infrastructure\Port\Input\Request\CheckCreateUserTokenRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * ワンタイムトークンチェック
 * @property CheckCreateUserToken $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var CheckCreateUserToken ワンタイムトークンチェック */
     private $service;
    /** @var Responder ワンタイムトークンチェックレスポンス */
    private $responder;

    /**
     * Create a new controller instance.
     *
     * @param CheckCreateUserToken $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        CheckCreateUserToken $service,
        Responder $responder
    ) {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * ワンタイムトークンチェック処理
     *
     * @param RequestValidation $request
     * @return Response
     */
    public function __invoke(RequestValidation $request): Response
    {
        $userInfo = $this->service->execute(new CheckCreateUserTokenRequest(new RequestValue($request)));
        return $this->responder
            ->setValue(new ResponseValue($userInfo))
            ->response();
    }
}
