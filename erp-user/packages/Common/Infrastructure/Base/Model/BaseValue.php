<?php
declare(strict_types=1);

namespace Common\Infrastructure\Bass\Model;

use Base\Model\BaseValue as BaseValueTrait;
use Base\Model\BaseValidation as BaseValidationTrait;

/**
 * バリューオブジェクトのベースクラス
 *
 * @method mixed getValue()
 * @return array
 */
abstract class BaseValue
{
    use BaseValueTrait, BaseValidationTrait;
}
