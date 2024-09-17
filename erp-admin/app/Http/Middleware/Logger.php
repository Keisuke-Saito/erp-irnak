<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Logger
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        Log::channel('action')->info(
            'request',
            $this->maskRequest($request->all())
        );
        $response = $next($request);
        if ($response instanceof BinaryFileResponse) {
            Log:: channel('action')->info(
                'file response'
            );
        } elseif ($response->exception) {
            Log:: channel('action')->info(
                'error response'
            );
        } else {
            Log:: channel('action')->info(
                'response',
                [json_encode($this->maskRequest($response->getOriginalContent()), JSON_UNESCAPED_UNICODE)]
            );
        }

        return $response;
    }

    public function maskRequest($params)
    {
        # password、password_confirmationという名目で送られてきた内容のマスクをしています。
        # 他の項目にもマスクをかける場合はここに追記します
        if (is_array($params)) {
            array_walk_recursive($params, function (&$val, $key) {
                if (($key === 'password')||($key === 'password_confirmation')) {
                    $val = '********';
                }
            });
        }
        return $params;
    }
}