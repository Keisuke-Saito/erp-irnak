<?php
declare(strict_types=1);

namespace App\Http\Api\Employee\Update;

use App\Http\Api\Base\Controller\Controller;
use Employee\App\Services\Update;
use Employee\Infrastructure\Port\Input\Request\UpdateRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

/**
 * 従業員更新
 * @property Update $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var Update 従業員更新 */
     private $service;
    /** @var Responder 従業員更新レスポンス */
    private $responder;

    /**
     * Create a new controller instance.
     *
     * @param Update $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        Update $service,
        Responder $responder
    ) {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * 従業員更新処理
     *
     * @param RequestValidation $request
     * @return Response
     */
    public function __invoke(RequestValidation $request): Response
    {
        $this->service->execute(new UpdateRequest(new RequestValue($request)));
        return $this->responder->response();
    }
}
