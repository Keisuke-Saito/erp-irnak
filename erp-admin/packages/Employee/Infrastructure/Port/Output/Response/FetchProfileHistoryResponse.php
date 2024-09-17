<?php
declare(strict_types=1);

namespace Employee\Infrastructure\Port\Output\Response;

use Employee\App\Port\OutputAdapter;
use Employee\App\Collections\EmployeeCollection;

/**
 * 従業員詳細情報履歴レスポンス
 * @property EmployeeCollection $profileHistory
 */
final class FetchProfileHistoryResponse implements OutputAdapter
{
    /** @var EmployeeCollection 従業員詳細情報履歴 */
    private $profileHistory;

    /**
     * Store a new controller instance.
     *
     * @param EmployeeCollection $profileHistory
     * @return void
     */
    public function __construct(
        EmployeeCollection $profileHistory
    ){
        $this->profileHistory = $profileHistory;
    }

    /**
     * 従業員詳細情報履歴
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->profileHistory->toArray();
    }
}
