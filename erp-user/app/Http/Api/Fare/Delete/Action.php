<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\Delete;

use App\Http\Api\Base\Controller\Controller;
use Fare\App\Services\Delete;
use Fare\Infrastructure\Port\Input\Request\DeleteRequest;
use Illuminate\Http\Response;

/**
 * 交通費削除
 * @property Delete $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var Delete 交通費削除 */
     private $service;
    /** @var Responder 交通費削除レスポンス */
    private $responder;

    /**
     * Create a new controller instance.
     *
     * @param Delete $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        Delete $service,
        Responder $responder
    ) {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * 交通費削除処理
     *
     * @param RequestValidation $request
     * @return Response
     */
    public function __invoke(RequestValidation $request): Response
    {
        $this->service->execute(new DeleteRequest(new RequestValue($request)));
        return $this->responder->response();
    }
}
