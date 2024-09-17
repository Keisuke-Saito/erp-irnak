<?php
declare(strict_types=1);

namespace Database\Seeders\Master;

use App\Models\BelongMst;
use Illuminate\Database\Seeder;

class BelongMstSeeder extends Seeder
{
    /**
     * 所属情報作成
     *
     * @return void
     */
    public function run()
    {
        BelongMst::factory()->create([
            'belong_id' => 1,
            'name' => 'webe',
            'description' => 'webe',
        ]);
        BelongMst::factory()->create([
            'belong_id' => 2,
            'name' => 'vuetech',
            'description' => 'vuetech',
        ]);
        BelongMst::factory()->create([
            'belong_id' => 99,
            'name' => 'その他',
            'description' => 'その他',
        ]);
    }
}
