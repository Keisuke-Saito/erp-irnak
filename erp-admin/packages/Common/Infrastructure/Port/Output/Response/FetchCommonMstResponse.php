<?php
declare(strict_types=1);

namespace Common\Infrastructure\Port\Output\Response;

use Common\App\Port\OutputAdapter;
use Common\App\Collections\MstCollection;

/**
 * 一般マスタ情報レスポンス
 * @property MstCollection $commonMst
 */
final class FetchCommonMstResponse implements OutputAdapter
{
    /** @var MstCollection 一般マスタ情報 */
    private $commonMst;

    /**
     * Store a new controller instance.
     *
     * @param MstCollection $commonMst
     * @return void
     */
    public function __construct(
        MstCollection $commonMst
    ){
        $this->commonMst = $commonMst;
    }

    /**
     * 一般マスタ情報取得
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->commonMst->toArray();
    }
}
