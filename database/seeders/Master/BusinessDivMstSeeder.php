<?php
declare(strict_types=1);

namespace Database\Seeders\Master;

use App\Models\BusinessDivMst;
use Illuminate\Database\Seeder;

class BusinessDivMstSeeder extends Seeder
{
    /**
     * 業務区分情報作成
     *
     * @return void
     */
    public function run()
    {
        BusinessDivMst::factory()->create([
            'business_div_id' => 1,
            'name' => '内勤',
            'description' => '内勤',
        ]);
        BusinessDivMst::factory()->create([
            'business_div_id' => 2,
            'name' => 'SES',
            'description' => 'SES',
        ]);
        BusinessDivMst::factory()->create([
            'business_div_id' => 3,
            'name' => '販売',
            'description' => '販売',
        ]);
        BusinessDivMst::factory()->create([
            'business_div_id' => 4,
            'name' => '営業',
            'description' => '営業',
        ]);
        BusinessDivMst::factory()->create([
            'business_div_id' => 5,
            'name' => 'ヘルプデスク',
            'description' => 'ヘルプデスク',
        ]);
        BusinessDivMst::factory()->create([
            'business_div_id' => 99,
            'name' => 'その他',
            'description' => 'その他',
        ]);
    }
}
