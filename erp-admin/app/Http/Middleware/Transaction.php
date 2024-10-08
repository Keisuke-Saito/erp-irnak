<?php
namespace App\Http\Middleware;

use Closure;
use Base\Exceptions\ValidationException as PackageValidationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Transaction
{
    public function handle($request, Closure $next)
    {
        if (!$request->isMethod("get")) {
            \DB::beginTransaction();
        }
        $response = $next($request);
        if (!$request->isMethod("get")) {
            if ($response instanceof BinaryFileResponse) {
                \DB::commit();
            } elseif (
                $response->exception
                && !$response->exception instanceof PackageValidationException
                && !$response->exception instanceof ValidationException) {
                \DB::rollBack();
            } else {
                \DB::commit();
            }
        }
        return $response;
    }
}