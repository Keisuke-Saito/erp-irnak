<?php
declare(strict_types=1);

namespace Fare\App\Collections;

use Carbon\Carbon;

use Fare\Infrastructure\Base\Model\BaseCollection;
use Fare\App\Models\Fare;
use Fare\App\Models\FareDetail;

/**
 * FareCollect
 * @property FareDetail[] $items
 * @property Fare $fare
 * @property string $target
 * @method self push($value)
 * @method array toArray()
 */
class FareDetailCollection extends BaseCollection
{
    /** @var Fare 交通費情報 */
    private $fare;
    /** @var string 対象年月 */
    private $target;

    /**
     * @param array $value
     * @return void
     */
    public function __construct(array $value = [])
    {
        parent::__construct($value);
    }

    /**
     * 交通費情報をセット
     *
     * @param Fare $fare
     * @return self
     */
    public function setFare(Fare $fare): self
    {
        $this->fare = $fare;
        return $this;
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
            'fare' => $this->fare->toArray(),
            'list' => parent::toArray()
        ];
    }
}
