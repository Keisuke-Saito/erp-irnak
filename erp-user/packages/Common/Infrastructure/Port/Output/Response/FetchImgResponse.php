<?php
declare(strict_types=1);

namespace Common\Infrastructure\Port\Output\Response;

use Common\App\Port\OutputAdapter;
use Common\App\Models\ImageFile;

/**
 * 画像情報レスポンス
 * @property ImageFile $img
 */
final class FetchImgResponse implements OutputAdapter
{
    /** @var ImageFile 画像情報 */
    private $img;

    /**
     * Store a new controller instance.
     *
     * @param ImageFile $img
     * @return void
     */
    public function __construct(
        ImageFile $img
    ){
        $this->img = $img;
    }

    /**
     * 画像情報取得
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->img->toArray();
    }
}
