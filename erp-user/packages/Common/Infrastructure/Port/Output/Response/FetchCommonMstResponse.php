<?php
declare(strict_types=1);

namespace Common\Infrastructure\Port\Output\Response;

use Common\App\Port\OutputAdapter;
use Common\App\Collections\Collection;

/**
 * 一般マスタ情報レスポンス
 * @property Collection $commonMst
 */
final class FetchCommonMstResponse implements OutputAdapter
{
    /** @var Collection 一般マスタ情報 */
    private $commonMst;

    /**
     * Store a new controller instance.
     *
     * @param Collection $commonMst
     * @return void
     */
    public function __construct(
        Collection $commonMst
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
