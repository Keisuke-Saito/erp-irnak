<?php
declare(strict_types=1);

namespace Common\App\Collections;

use Common\Infrastructure\Base\Model\BaseCollection;

/**
 * collect
 * @property array $items
 * @method self push($value)
 * @method array toArray()
 */
class MstCollection extends BaseCollection
{
    /**
     * @param array $value
     * @return void
     */
    public function __construct(array $value = [])
    {
        parent::__construct($value);
    }
}
