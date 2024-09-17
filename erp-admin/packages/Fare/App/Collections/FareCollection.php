<?php
declare(strict_types=1);

namespace Fare\App\Collections;

use Carbon\Carbon;

use Fare\Infrastructure\Base\Model\BaseCollection;

/**
 * FareCollect
 * @property array $items
 * @property string $target
 * @property string $targetYear
 * @property string $targetMonth
 * @method self push($value)
 * @method array toArray()
 */
class FareCollection extends BaseCollection
{
    /** @var string 対象年月 */
    private $target;
    /** @var string 対象年 */
    private $targetYear;
    /** @var string 対象月 */
    private $targetMonth;

    /**
     * @param array $value
     * @return void
     */
    public function __construct(array $value = [])
    {
        parent::__construct($value);
    }

    /**
     * 対象年月をセット
     *
     * @param Carbon $target
     * @return self
     */
    public function setTarget(Carbon $target): self
    {
        $this->target = $target->copy()->format('Y-m');
        $this->targetYear = $target->copy()->format('Y');
        $this->targetMonth = $target->copy()->format('m');
        return $this;
    }

    /**
     * 対象年月
     *
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * 配列に変換
     *
     * @return array
     */
    public function all(): array
    {
        return [
            'targetTotal' => $this->sum('thisMonthCount'),
            'target' => $this->target,
            'targetYear' => $this->targetYear,
            'targetMonth' => $this->targetMonth,
            'list' => parent::toArray()
        ];
    }
}
