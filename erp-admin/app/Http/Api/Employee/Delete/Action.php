<?php
declare(strict_types=1);

namespace App\Http\Api\Employee\Delete;

use App\Http\Api\Base\Controller\Controller;
use Employee\App\Services\Delete;
use Employee\Infrastructure\Port\Input\Request\DeleteRequest;
use Illuminate\Http\Response;

/**
 * 従業員ログイン情報削除
 * @property Delete $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var Delete 従業員ログイン情報削除 */
     private $service;
    /** @var Responder 従業員ログイン情報削除レスポンス */
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
     * 従業員ログイン情報削除処理
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
