<?php
declare(strict_types=1);

namespace App\Http\Api\Employee\Store;

use App\Http\Api\Base\Controller\Controller;
use Employee\App\Services\Store;
use Employee\Infrastructure\Port\Input\Request\StoreRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

/**
 * 社員情報追加
 * @property Store $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var Store 社員情報 */
    private $service;
    /** @var Responder 社員情報レスポンス */
    private $responder;

    /**
     * Store a new controller instance.
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
     * 社員情報登録
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
