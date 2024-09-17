<?php
declare(strict_types=1);

namespace App\Http\Api\Employee\FetchAll;

use App\Http\Api\Base\Controller\Controller;
use Employee\App\Services\FetchAllEmployee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * 全従業員情報取得処理
 * @property FetchAllEmployee $service
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var FetchAllEmployee 全従業員情報取得処理 */
     private $service;
    /** @var Responder 全従業員情報レスポンス */
    private $responder;

    /**
     * Create a new controller instance.
     *
     * @param FetchAllEmployee $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        FetchAllEmployee $service,
        Responder $responder
    ) {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * 全従業員取得処理
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
