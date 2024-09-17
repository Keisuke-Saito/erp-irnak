<?php
declare(strict_types=1);

namespace Database\Seeders\Master;

use App\Models\PositionMst;
use Illuminate\Database\Seeder;

class PositionMstSeeder extends Seeder
{
    /**
     * 役職情報作成
     *
     * @return void
     */
    public function run()
    {
        PositionMst::factory()->create([
            'position_id' => 99,
            'name' => 'その他',
            'description' => 'その他',
        ]);
    }
}
