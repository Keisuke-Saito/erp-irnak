<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\Confirm;

use App\Http\Api\Base\Controller\Controller;
use Fare\App\Services\Confirm;
use Fare\Infrastructure\Port\Input\Request\ConfirmRequest;
use Illuminate\Http\Response;

/**
 * 交通費確定
 * @property Confirm $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var Confirm 交通費確定 */
    private $service;
    /** @var Responder 交通費確定レスポンス */
    private $responder;

    /**
     * Create a new controller instance.
     *
     * @param Confirm $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        Confirm $service,
        Responder $responder
    ) {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * 交通費確定処理
     *
     * @param RequestValidation $request
     * @return Response
     */
    public function __invoke(RequestValidation $request): Response
    {
        $this->service->execute(new ConfirmRequest(new RequestValue($request)));
        return $this->responder->response();
    }
}
