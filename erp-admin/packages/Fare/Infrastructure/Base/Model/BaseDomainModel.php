<?php
declare(strict_types=1);

namespace Fare\Infrastructure\Base\Model;

use Base\Model\BaseDomainModel as BaseModelTrait;

/**
 * モデルのベースクラス
 *
 * @method array toArray()
 * @method string convSnake(string $key)
 * @return array
 */
abstract class BaseDomainModel
{
    use BaseModelTrait;
}
