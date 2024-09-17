<?php
declare(strict_types=1);

namespace App\Http\Api\Employee\CsvDownloadExample;

use App\Http\Api\Base\Connector\BaseRequestValue;
use Carbon\Carbon;

/**
 * CSV取得リクエスト
 * @property Carbon $target
 * @property string[] $erpIdList
 * @property string $filename
 * @property string[] $header
 * @property string $csvChara
 * @property string $dataChara
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
    /** @var Carbon 対象月 */
    protected $target;
    /** @var string ファイル名 */
    protected $filename;
    /** @var string[] CSV用ヘッダー情報 */
    protected $header = ['スタッフコード', '名前', '所属', '状態'];
    /** @var string データ配列の文字コード */
    protected $dataChara = 'utf-8';
    /** @var string ダウンロードしたい文字コード */
    protected $csvChara = 'SJIS-win';
    /** @var string CSV用ファイル名フォーマット */
    private const FILENAME_FORMAT = 'employee_%s_%s_%s.csv';

    /**
     * Store a new controller instance.
     *
     * @param RequestValidation $request
     * @return void
     */
    public function __construct(
        RequestValidation $request
    ){
        $this->target = new Carbon($request['targetMonth']);
        $this->filename = sprintf(self::FILENAME_FORMAT, $request['targetMonth'], $this->target->timestamp, Carbon::now()->format('Ymd'));
    }
}
