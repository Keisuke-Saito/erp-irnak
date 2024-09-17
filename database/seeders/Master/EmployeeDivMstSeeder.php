<?php
declare(strict_types=1);

namespace Database\Seeders\Master;

use App\Models\EmployeeDivMst;
use Illuminate\Database\Seeder;

class EmployeeDivMstSeeder extends Seeder
{
    /**
     * 従業員区分情報作成
     *
     * @return void
     */
    public function run()
    {
        EmployeeDivMst::factory()->create([
            'employee_div_id' => 1,
            'name' => '正社員',
            'description' => '正社員',
        ]);
        EmployeeDivMst::factory()->create([
            'employee_div_id' => 2,
            'name' => 'アルバイト',
            'description' => 'アルバイト',
        ]);
        EmployeeDivMst::factory()->create([
            'employee_div_id' => 3,
            'name' => '契約社員',
            'description' => '契約社員',
        ]);
        EmployeeDivMst::factory()->create([
            'employee_div_id' => 4,
            'name' => '派遣社員',
            'description' => '派遣社員',
        ]);
        EmployeeDivMst::factory()->create([
            'employee_div_id' => 5,
            'name' => '嘱託社員',
            'description' => '嘱託社員',
        ]);
        EmployeeDivMst::factory()->create([
            'employee_div_id' => 99,
            'name' => 'その他',
            'description' => 'その他',
        ]);
    }
}
