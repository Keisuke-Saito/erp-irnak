<?php

declare(strict_types=1);

namespace App\Http\Api\Employee\FetchProfileDetail;

use App\Http\Api\Base\Controller\Controller;
use Employee\App\Services\FetchProfileDetail;
use Employee\Infrastructure\Port\Input\Request\FetchProfileDetailRequest;
use Illuminate\Http\Response;

/**
 * ユーザー別情報取得
 * @property FetchProfileDetail $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var FetchProfileDetail ユーザー別情報取得 */
    private $service;
    /** @var Responder ユーザー別情報取得 */
    private $responder;

    /**
     * FetchTargetMonthDetail a new controller instance.
     *
     * @param FetchProfileDetail $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(FetchProfileDetail $service, Responder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * ユーザー別情報取得
     *
     * @param RequestValidation $request
     * @return Response
     */
    public function __invoke(RequestValidation $request): Response
    {
        $profileDetail = $this->service->execute(new FetchProfileDetailRequest(new RequestValue($request)));
        return $this->responder
            ->setValue(new ResponseValue($profileDetail))
            ->response();
    }
}
