<?php
declare(strict_types=1);

namespace Fare\Domain\Collections;

use Fare\Infrastructure\Base\Model\BaseCollection;
use Fare\Domain\Models\StoreDetail\StoreDetailModel;

/**
 * FareCollect
 * @property StoreDetailModel[] $items
 * @method self push($value)
 * @method array toArray()
 */
class StoreDetailCollection extends BaseCollection
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
