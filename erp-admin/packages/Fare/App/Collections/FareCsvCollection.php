<?php
declare(strict_types=1);

namespace Fare\App\Collections;

use Fare\Infrastructure\Base\Model\BaseCollection;

/**
 * FareCsvCollection
 * @property array $items
 * @method self push($value)
 * @method array toArray()
 */
class FareCsvCollection extends BaseCollection
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
