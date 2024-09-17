<?php
declare(strict_types=1);

namespace App\Http\Api\Auth\Logout;

use App\Http\Api\Base\Controller\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * ログイン
 * @property Responder $responder
 */
final class Action extends Controller
{
    /** @var Responder ログアウトレスポンス */
    private $responder;

    /**
     * Create a new controller instance.
     *
     * @param Logout $service
     * @param Responder $responder
     * @return void
     */
    public function __construct(
        Responder $responder
    ) {
        $this->responder = $responder;
    }

    /**
     * ログアウト処理
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $admin = $request->user();
        $admin->api_token = null;
        $admin->save();
        return $this->responder->response();
    }
}
