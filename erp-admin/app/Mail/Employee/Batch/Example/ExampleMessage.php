<?php
declare(strict_types=1);

namespace App\Mail\Employee\Batch\Example;

use App\Mail\Base\Models\BaseMailModel;
use Illuminate\Support\Collection;

/**
 * 従業員へのメッセージバッチ
 *
 * @property Collection $target
 * @property string $message
 */
final class ExampleMessage extends BaseMailModel
{
    /** @var Collection 従業員情報 */
    protected $target;
    /** @var string メッセージ */
    protected $message;
}
