<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\FetchImg;

use App\Http\Api\Base\Controller\Controller;
use Common\App\Services\FetchImg;
use Common\Infrastructure\Port\Input\Request\FetchImgRequest;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * 領収書画像情報を取得
 * @property FetchImg $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var FetchImg 領収書画像情報 */
    private $service;
    /** @var Responder 領収書画像情報レスポンス */
    private $responder;

    /**
     * Store a new controller instance.
     *
     * @param FetchImg $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        FetchImg $service,
        Responder $responder
    ) {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * 領収書画像情報を取得
     *
     * @param RequestValidation $request
     * @return Response|BinaryFileResponse
     */
    public function __invoke(RequestValidation $request)
    {
        $image = $this->service->execute(new FetchImgRequest(new RequestValue($request)));
        return $this->responder
            ->setValue(new ResponseValue($image))
            ->response();
    }
}
