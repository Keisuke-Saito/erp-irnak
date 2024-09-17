<?php
declare(strict_types=1);

namespace Database\Seeders\TestData;

use App\Models;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CreateTestUserSeeder extends Seeder
{
    private const USER_NUM   = 30;
    private const MONTH_NUM  = 12;
    private const DETAIL_NUM = 5;
    /**
     * testユーザー作成
     *
     * @return void
     */
    public function run()
    {
        $now = new Carbon();
        // ユーザー認証情報
        for ($m = 1; $m < self::USER_NUM; $m++) {
            $subMonth = $now->copy()->subMonthNoOverflow();
            $erpId = Models\User::factory()->create([
                'hash_email' => hash('sha256', "test{$m}@test.com")
            ])->erp_id;
            Models\Profile::factory()->create([
                'erp_id' => $erpId,
                'email' => "test{$m}@test.com",
            ]);
            for ($i = 0; $i < self::MONTH_NUM; $i++) {
                $targetMonth = $now->copy()->subMonthNoOverflow($i)->format('Y-m');

                // 交通費情報
                $fareId = Models\Fare::factory()->create([
                    'erp_id' => $erpId,
                    'target_month' => $targetMonth
                ])->uuid;

                for ($s = 0; $s < self::DETAIL_NUM; $s++) {
                    // 交通費詳細情報
                    Models\FareDetail::factory()->create([
                        'fare_id' => $fareId,
                        'target_date' => $targetMonth .'-' . rand(1, 28)
                    ]);
                }
            }
        }

        // 退職者情報
        $subMonth = $now->copy()->subMonthNoOverflow(1);
        $erpId = Models\User::factory()->create([
            'hash_email' => hash('sha256', 'retirement@test.com'),
            'deleted_at' => $subMonth
        ])->erp_id;
        Models\Profile::factory()->create([
            'erp_id' => $erpId,
            'email' => "retirement@test.com",
            'retirement_at' => $subMonth
        ]);
        $targetMonth = $now->copy()->subMonthNoOverflow(2)->format('Y-m');

        // 交通費情報
        $fareId = Models\Fare::factory()->create([
            'erp_id' => $erpId,
            'target_month' => $targetMonth
        ])->uuid;

        for ($x = 0; $x < self::DETAIL_NUM; $x++) {
            Models\FareDetail::factory()->create([
                'fare_id' => $fareId,
                'target_date' => $targetMonth .'-' . rand(1, 28)
            ]);
        }
    }
}
