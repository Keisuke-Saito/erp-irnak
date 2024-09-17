<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\FetchTargetMonthDetail;

use App\Http\Api\Base\Controller\Controller;
use Fare\App\Services\FetchTargetMonthDetail;
use Fare\Infrastructure\Port\Input\Request\FetchTargetMonthRequest;
use Illuminate\Http\Response;

/**
 * 交通費詳細情報取得
 * @property FetchTargetMonthDetail $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var FetchTargetMonthDetail 交通費詳細情報 */
    private $service;
    /** @var Responder 交通費詳細情報レスポンス */
    private $responder;

    /**
     * FetchTargetMonthDetail a new controller instance.
     *
     * @param FetchTargetMonthDetail $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        FetchTargetMonthDetail $service,
        Responder $responder
    ) {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * 交通費詳細情報取得
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
