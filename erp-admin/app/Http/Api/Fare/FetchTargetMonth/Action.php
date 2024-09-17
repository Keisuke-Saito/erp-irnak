<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\FetchTargetMonth;

use App\Http\Api\Base\Controller\Controller;
use Fare\App\Services\FetchTargetMonth;
use Fare\Infrastructure\Port\Input\Request\FetchTargetMonthRequest;
use Illuminate\Http\Response;

/**
 * 交通費情報取得
 * @property FetchTargetMonth $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var FetchTargetMonth 交通費情報 */
    private $service;
    /** @var Responder 交通費情報レスポンス */
    private $responder;

    /**
     * FetchTargetMonth a new controller instance.
     *
     * @param FetchTargetMonth $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        FetchTargetMonth $service,
        Responder $responder
    ) {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * 交通費情報取得
     *
     * @param RequestValidation $request
     * @return Response
     */
    public function __invoke(RequestValidation $request): Response
    {
        $fares = $this->service->execute(new FetchTargetMonthRequest(new RequestValue($request)));
        return $this->responder
            ->setValue(new ResponseValue($fares))
            ->response();
    }
}
