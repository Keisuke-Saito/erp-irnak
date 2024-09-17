<?php
declare(strict_types=1);

namespace Employee\Infrastructure\Port\Output\Response;

use Employee\App\Port\OutputAdapter;
use Employee\App\Collections\EmployeeCollection;

/**
 * 全従業員情報レスポンス
 * @property EmployeeCollection $commonMst
 */
final class FetchAllEmployeeResponse implements OutputAdapter
{
    /** @var EmployeeCollection 全従業員情報 */
    private $commonMst;

    /**
     * Store a new controller instance.
     *
     * @param EmployeeCollection $commonMst
     * @return void
     */
    public function __construct(
        EmployeeCollection $commonMst
    ){
        $this->commonMst = $commonMst;
    }

    /**
     * 全従業員情報取得
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->commonMst->toArray();
    }
}
