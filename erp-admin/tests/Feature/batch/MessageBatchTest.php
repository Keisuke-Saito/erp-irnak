<?php

namespace Tests\Feature\batch;

use App\Models\Profile;
use App\Mail\Employee\Batch\Example\ExampleMessageMail;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

class MessageBatchTest extends TestCase
{
    use RefreshDatabase;

    protected $messageBatch;

    public function setUp():void
    {
        parent::setUp();
        $spy = Log::spy();
        Log::shouldReceive('channel')->andReturn($spy);
        Mail::fake();
    }

    /**
     * @param $param
     * @param $expect
     * @test
     * @dataProvider dataProviderSendMessage
     * @return void
     */
    public function sendMessage($param, $expect)
    {
        if ($param['needUser']) {
            Profile::factory()->create([
                'erp_id' => 'login',
                'email' => 'test@test.com',
                'joined_at' => $param['joined_at'],
                'retirement_at' => $param['retirement_at']
            ]);
        }

        Artisan::call($param['command']);

        if ($expect['send']) {
            Mail::assertSent(ExampleMessageMail::class);
            Mail::assertSent(function (ExampleMessageMail $mail) use ($expect) {
                return $mail->messageText === $expect['message'];
            });
        } else {
            Mail::assertNothingSent();
            Log::shouldHaveReceived('warning')->once()->with($expect['message']);
        }
    }
    public function dataProviderSendMessage(): array
    {
        return [
            '従業員なし' => [
                [
                    'needUser' => false,
                    'command' => 'batch:message'
                ],[
                    'send'  => false,
                    'message' => 'バッチは停止されました。従業員がいませんでした'
                ]
            ],
            '入社前情報のみ' => [
                [
                    'needUser' => true,
                    'joined_at' => null,
                    'retirement_at' => null,
                    'command' => 'batch:message'
                ],[
                    'send'  => false,
                    'message' => 'バッチは停止されました。従業員がいませんでした'
                ]
            ],
            '退職者情報のみ' => [
                [
                    'needUser' => true,
                    'joined_at' => '2020-01-01 00:00:00',
                    'retirement_at' => '2021-01-01 00:00:00',
                    'command' => 'batch:message'
                ],[
                    'send'  => false,
                    'message' => 'バッチは停止されました。従業員がいませんでした'
                ]
            ],
            '正常系,引数なし' => [
                [
                    'needUser' => true,
                    'joined_at' => '2020-01-01 00:00:00',
                    'retirement_at' => null,
                    'command' => 'batch:message'
                ],[
                    'send'  => true,
                    'message' => 'お疲れ様です！'
                ]
            ],
            '正常系,引数あり' => [
                [
                    'needUser' => true,
                    'joined_at' => '2020-01-01 00:00:00',
                    'retirement_at' => null,
                    'command' => 'batch:message テストメッセージ'
                ],[
                    'send'  => true,
                    'message' => 'テストメッセージ'
                ]
            ],
            '正常系,引数あり(空文字)' => [
                [
                    'needUser' => true,
                    'joined_at' => '2020-01-01 00:00:00',
                    'retirement_at' => null,
                    'command' => 'batch:message ""'
                ],[
                    'send'  => false,
                    'message' => 'バッチは停止されました。メッセージを指定してください。'
                ]
            ],
        ];
    }
}
