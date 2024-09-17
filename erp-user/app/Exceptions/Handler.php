<?php

namespace App\Exceptions;

use Throwable;
use Base\Exceptions\ValidationException as PackageValidationException;
use Base\Exceptions\NotFoundException as PackageNotFoundException;
use Base\Exceptions\ConflictException as PackageConflictException;
use Base\Exceptions\UnauthorizedException as PackageUnauthorizedException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Psr\Log\LogLevel;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * 例外タイプと関係するカスタムログレベルのリスト
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        PackageNotFoundException::class => LogLevel::NOTICE,
        PackageConflictException::class => LogLevel::NOTICE,
        PackageUnauthorizedException::class => LogLevel::NOTICE,
        PackageValidationException::class => LogLevel::INFO,
        ValidationException::class => LogLevel::INFO,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
}