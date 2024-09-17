<?php

namespace Tests\Feature\api;

use App\Models\Admin;
use App\Models\Fare;
use App\Models\FareDetail;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class FareDeleteApiTest extends TestCase
{
    use RefreshDatabase;

    private const PATH = '/api/fare/delete';

    private $accessToken = null;

    public function setUp():void
    {
        parent::setUp();
        Admin::create([
            'login_id' => 'admin',
            'password' => \Hash::make('password')
        ]);
        $response = $this->post('/api/auth/login', [
            'username' => 'admin',
            'password' => 'password'
        ]);
        $response->assertOk();
        $this->accessToken = $response->json('token');
    }

    /**
     * @param $param
     * @param $expect
     * @test
     * @dataProvider dataProviderFareDelete
     * @return void
     */
    public function fareDelete($param, $expect)
    {
        if ($param['needFareDetail']) {
            $now = new Carbon();
            $targetMonth = $now->format('Y-m');
            $fareId = Fare::factory()->create([
                'erp_id' => 'test',
                'target_month' => $targetMonth
            ])->uuid;
            $detail_id = FareDetail::factory()->create([
                'fare_id' => $fareId,
                'target_date' => $targetMonth .'-' . rand(1, 28)
            ])->uuid;
            if ($param['useDbId']) {
                $param['payload'] = [
                    'uuid' => $detail_id
                ];
            }
        }
        $response = $this->delete(self::PATH, $param['payload'], [
            'Acceptn' => 'multipart/form-data',
            'Authorization' => 'Bearer '.$this->accessToken
        ]);

        if ($expect['error']) {
            $this->assertEquals($response->exception->status, $expect['status']);
            $this->assertEquals($response->exception->getMessage(), $expect['responce']);
        } else {
            $response->assertStatus(200);
        }

    }
    public function dataProviderFareDelete(): array
    {
        $uuid = Uuid::uuid4()->toString();
        return [
            '異常系,uuid未指定' => [
                [
                    'needFareDetail' => false,
                    'payload'        => []
                ],[
                    'error'    => true,
                    'status'   => 422,
                    'responce' => 'IDは、必ず指定してください。'
                ]
            ],
            '異常系,uuid空文字' => [
                [
                    'needFareDetail' => false,
                    'payload'        => [
                        'uuid' => ''
                    ]
                ],[
                    'error'    => true,
                    'status'   => 422,
                    'responce' => 'IDは、必ず指定してください。'
                ]
            ],
            '異常系,数字' => [
                [
                    'needFareDetail' => false,
                    'payload'        => [
                        'uuid' => 123
                    ]
                ],[
                    'error'    => true,
                    'status'   => 422,
                    'responce' => 'IDは、有効なUUIDでなければなりません。'
                ]
            ],
            '異常系,uuid以外の文字列' => [
                [
                    'needFareDetail' => false,
                    'payload'        => [
                        'uuid' => 'test'
                    ]
                ],[
                    'error'    => true,
                    'status'   => 422,
                    'responce' => 'IDは、有効なUUIDでなければなりません。'
                ]
            ],
            '異常系,存在しないuuidを指定' => [
                [
                    'needFareDetail' => true,
                    'useDbId'        => false,
                    'payload'        => [
                        'uuid' => $uuid
                    ]
                ],[
                    'error'    => true,
                    'status'   => 422,
                    'responce' => '対象のレコードがありません。'
                ]
            ],
            '正常系,存在するuuidを指定' => [
                [
                    'needFareDetail' => true,
                    'useDbId'        => true
                ],[
                    'error' => false
                ]
            ],
        ];
    }
}
