<?php
declare(strict_types=1);

namespace Employee\Infrastructure\Port\Output\Response;

use Employee\App\Port\OutputAdapter;
use Employee\App\Models\Employee;

/**
 * 従業員詳細情報レスポンス
 * @property Employee $profile
 */
final class FetchProfileDetailResponse implements OutputAdapter
{
    /** @var Employee 従業員詳細情報 */
    private $profile;

    /**
     * Store a new controller instance.
     *
     * @param Employee $profile
     * @return void
     */
    public function __construct(
        Employee $profile
    ){
        $this->profile = $profile;
    }

    /**
     * 従業員詳細情報
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->profile->toArray();
    }
}
