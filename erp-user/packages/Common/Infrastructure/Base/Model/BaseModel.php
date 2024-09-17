<?php
declare(strict_types=1);

namespace Common\Infrastructure\Base\Model;

use Base\Model\BaseModel as BaseModelTrait;

/**
 * モデルのベースクラス
 *
 * @method array toArray()
 * @method string convSnake(string $key)
 */
abstract class BaseModel
{
    use BaseModelTrait;
}
