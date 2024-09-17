<?php
declare(strict_types=1);

namespace App\Http\Api\Common\FetchCommonMst;

use App\Http\Api\Base\Controller\Controller;
use Common\App\Services\FetchCommonMst;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * 一般マスタ情報取得処理
 * @property FetchCommonMst $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var FetchCommonMst 一般マスタ情報取得処理 */
     private $service;
    /** @var Responder 一般マスタ情報レスポンス */
    private $responder;

    /**
     * Create a new controller instance.
     *
     * @param FetchCommonMst $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        FetchCommonMst $service,
        Responder $responder
    ) {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * 一般マスタ処理
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        return $this->responder
            ->setValue(new ResponseValue($this->service->execute()))
            ->response();
    }
}
