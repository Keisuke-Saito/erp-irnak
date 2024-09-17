<?php
declare(strict_types=1);

namespace Employee\App\Collections;

use Employee\Infrastructure\Base\Model\BaseCollection;

/**
 * MasterCollection
 * @property array $items
 * @method self push($value)
 * @method array toArray()
 */
class MasterCollection extends BaseCollection
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
