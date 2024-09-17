<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\Store;

use App\Http\Api\Base\Controller\Controller;
use Fare\App\Services\Store;
use Fare\Infrastructure\Port\Input\Request\StoreRequest;
use Illuminate\Http\Response;

/**
 * 交通費登録
 * @property Store $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var Store 交通費登録 */
     private $service;
    /** @var Responder 交通費登録レスポンス */
    private $responder;

    /**
     * Create a new controller instance.
     *
     * @param Store $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        Store $service,
        Responder $responder
    ) {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * 交通費登録処理
     *
     * @param RequestValidation $request
     * @return Response
     */
    public function __invoke(RequestValidation $request): Response
    {
        $this->service->execute(new StoreRequest(new RequestValue($request)));
        return $this->responder->response();
    }
}