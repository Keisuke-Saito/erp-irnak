<?php
declare(strict_types=1);

namespace Common\App\Services;

use Common\App\QueryServices\CommonMstQueryInterface;
use Common\Infrastructure\Port\Output\Response\FetchCommonMstResponse;

/**
 * 一般マスタ情報取得処理
 * @property CommonMstQueryInterface $commonMstQuery
 */
final class FetchCommonMst
{
    /** @var CommonMstQueryInterface 一般マスタ情報情報接続 */
    private $commonMstQuery;

    /**
     * Store a new controller instance.
     *
     * @param CommonMstQueryInterface $commonMstQuery
     * @return void
     */
    public function __construct(
        CommonMstQueryInterface $commonMstQuery
    ){
        $this->commonMstQuery = $commonMstQuery;
    }

    /**
     * 一般マスタ情報取得処理
     *
     * @return FetchCommonMstResponse
     */
    public function execute()
    {
        $commonMst = $this->commonMstQuery->all();
        return new FetchCommonMstResponse($commonMst);
    }
}
