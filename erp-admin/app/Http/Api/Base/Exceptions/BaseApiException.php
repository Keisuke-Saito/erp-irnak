<?php
declare(strict_types=1);

namespace App\Http\Api\Base\Exceptions;

use Exception;
use Illuminate\Http\Response;

abstract class BaseApiException extends Exception
{
    public $status = 200;
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        $this->status = $this->code;
        return response()->json(
            [
                'message' => $this->message
            ],
            $this->code,
            [
                'Content-Type' => 'application/json',
            ],
            JSON_UNESCAPED_UNICODE
        );
    }
}
