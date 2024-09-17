<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\ShowHistory;

use App\Http\Api\Base\Controller\Controller;
use Fare\App\Services\ShowHistory;
use Fare\Infrastructure\Port\Input\Request\ShowHistoryRequest;
use Illuminate\Http\Response;

/**
 * 交通費履歴情報取得
 * @property ShowHistory $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var ShowHistory 交通費履歴情報 */
    private $service;
    /** @var Responder 交通費履歴情報レスポンス */
    private $responder;

    /**
     * ShowHistory a new controller instance.
     *
     * @param ShowHistory $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        ShowHistory $service,
        Responder $responder
    ) {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * 交通費履歴情報取得
     *
     * @param RequestValidation $request
     * @return Response
     */
    public function __invoke(RequestValidation $request): Response
    {
        $fares = $this->service->execute(new ShowHistoryRequest(new RequestValue($request)));
        return $this->responder
            ->setValue(new ResponseValue($fares))
            ->response();
    }
}
