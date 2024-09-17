<?php
declare(strict_types=1);

namespace Fare\Infrastructure\Port\Output\Response;

use Fare\App\Port\OutputAdapter;
use Fare\App\Collections\FareDetailCollection;

/**
 * 交通費詳細情報レスポンス
 * @property FareDetailCollection $fareDetail
 */
final class ShowHistoryResponse implements OutputAdapter
{
    /** @var FareDetailCollection 交通費詳細情報 */
    private $fareDetail;

    /**
     * Store a new controller instance.
     *
     * @param FareDetailCollection $fareDetail
     * @return void
     */
    public function __construct(
        FareDetailCollection $fareDetail
    ){
        $this->fareDetail = $fareDetail;
    }

    /**
     * 交通費詳細情報取得
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->fareDetail->all();
    }
}
