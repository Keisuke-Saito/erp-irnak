<?php
declare(strict_types=1);

namespace Database\Seeders\Master;

use App\Models\AffiliationDeptMst;
use Illuminate\Database\Seeder;

class AffiliationDeptMstSeeder extends Seeder
{
    /**
     * 所属部門情報作成
     *
     * @return void
     */
    public function run()
    {
        // ユーザー認証情報
        AffiliationDeptMst::factory()->create([
            'affiliation_dept_id' => 1,
            'name' => 'HR事業部',
            'description' => 'HR事業部',
        ]);
        AffiliationDeptMst::factory()->create([
            'affiliation_dept_id' => 2,
            'name' => 'WEBクリエイティブ事業部',
            'description' => 'WEBクリエイティブ事業部',
        ]);
        AffiliationDeptMst::factory()->create([
            'affiliation_dept_id' => 3,
            'name' => '総務部',
            'description' => '総務部',
        ]);
        AffiliationDeptMst::factory()->create([
            'affiliation_dept_id' => 99,
            'name' => 'その他',
            'description' => 'その他',
        ]);
    }
}