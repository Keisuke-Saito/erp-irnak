<?php
declare(strict_types=1);

namespace Fare\Infrastructure\Port\Output\Response;

use Fare\App\Port\OutputAdapter;
use Fare\App\Models\FareDetailTargetMonth;

/**
 * 交通費詳細情報レスポンス
 * @property FareDetailTargetMonth $fareDetailTargetMonth
 */
final class FetchTargetMonthDetailResponse implements OutputAdapter
{
    /** @var FareDetailTargetMonth 交通費詳細情報 */
    private $fareDetailTargetMonth;

    /**
     * Store a new controller instance.
     *
     * @param FareDetailTargetMonth $fareDetailTargetMonth
     * @return void
     */
    public function __construct(
        FareDetailTargetMonth $fareDetailTargetMonth
    ){
        $this->fareDetailTargetMonth = $fareDetailTargetMonth;
    }

    /**
     * 交通費詳細情報取得
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->fareDetailTargetMonth->toResponse();
    }
}
