<?php
declare(strict_types=1);

namespace Fare\Infrastructure\Port\Output\Response;

use Fare\App\Port\OutputAdapter;
use Fare\App\Collections\FareCollection;

/**
 * 交通費情報レスポンス
 * @property FareCollection $fareDetail
 */
final class FetchTargetMonthResponse implements OutputAdapter
{
    /** @var FareCollection 交通費情報 */
    private $fareDetail;

    /**
     * Store a new controller instance.
     *
     * @param FareCollection $fareDetail
     * @return void
     */
    public function __construct(
        FareCollection $fareDetail
    ){
        $this->fareDetail = $fareDetail;
    }

    /**
     * 交通費情報取得
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->fareDetail->all();
    }
}
