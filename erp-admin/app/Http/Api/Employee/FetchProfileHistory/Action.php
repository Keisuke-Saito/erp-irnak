<?php

declare(strict_types=1);

namespace App\Http\Api\Employee\FetchProfileHistory;

use App\Http\Api\Base\Controller\Controller;
use Employee\App\Services\FetchProfileHistory;
use Employee\Infrastructure\Port\Input\Request\FetchProfileHistoryRequest;
use Illuminate\Http\Response;

/**
 * ユーザー別情報履歴取得
 * @property FetchProfileHistory $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var FetchProfileHistory ユーザー別情報履歴取得 */
    private $service;
    /** @var Responder ユーザー別情報履歴取得 */
    private $responder;

    /**
     * FetchTargetMonthDetail a new controller instance.
     *
     * @param FetchProfileHistory $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(FetchProfileHistory $service, Responder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * ユーザー別情報履歴取得
     *
     * @param RequestValidation $request
     * @return Response
     */
    public function __invoke(RequestValidation $request): Response
    {
        $profileDetail = $this->service->execute(new FetchProfileHistoryRequest(new RequestValue($request)));
        return $this->responder
            ->setValue(new ResponseValue($profileDetail))
            ->response();
    }
}
