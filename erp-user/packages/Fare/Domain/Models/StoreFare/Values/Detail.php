<?php
declare(strict_types=1);

namespace Fare\Domain\Models\StoreFare\Values;

use Fare\Domain\Collections\StoreDetailCollection;
use Fare\Infrastructure\Bass\Model\BaseValue;

final class Detail extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '交通費詳細';

    /**
     * Store a new controller instance.
     *
     * @param $value
     * @return void
     */
    public function __construct(StoreDetailCollection $value)
    {
        $this->value = $value;
    }
}
