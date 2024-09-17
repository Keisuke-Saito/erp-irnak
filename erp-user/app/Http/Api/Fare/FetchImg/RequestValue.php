<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\FetchImg;

use App\Http\Api\Base\Connector\BaseRequestValue;

/**
 * 領収書画像取得リクエスト
 * @property string|null $filePath
 * @property string $disks
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
    /** @var string|null 領収書画像パス */
    protected $filePath;
    /** @var string 領収書画像パスタイプ */
    protected $disks = 'receipt';

    /**
     * Store a new controller instance.
     *
     * @param RequestValidation $request
     * @return void
     */
    public function __construct(
        RequestValidation $request
    ){
        $this->filePath = $request['filePath'] ?? null;
    }
}
