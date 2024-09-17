<?php
declare(strict_types=1);

namespace Auth\App\Collections;

use Auth\Infrastructure\Base\Model\BaseCollection;

/**
 * ProfileCollect
 * @property array $items
 * @method self push($value)
 * @method array toArray()
 */
class ProfileCollection extends BaseCollection
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
