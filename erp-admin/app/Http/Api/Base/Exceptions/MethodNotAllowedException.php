<?php
declare(strict_types=1);

namespace App\Http\Api\Base\Exceptions;

/**
 * 想定されていない呼び出しのエラー
 * @property string $code
 */
final class MethodNotAllowedException extends BaseApiException
{
    /** @var string エラーコード */
    protected $code = 405;
}
