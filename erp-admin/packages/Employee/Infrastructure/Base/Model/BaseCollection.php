<?php
declare(strict_types=1);

namespace Employee\Infrastructure\Base\Model;

use Base\Model\BaseCollection as BaseCollectionTrait;

/**
 * コレクションのベースクラス
 *
 * @property array $items
 * @method self push($value)
 * @method array toArray()
 */
abstract class BaseCollection
{
    use BaseCollectionTrait;
}
