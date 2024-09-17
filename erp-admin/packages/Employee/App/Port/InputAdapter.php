<?php
declare(strict_types=1);

namespace Employee\App\Port;

/**
 * リクエストラッパー
 */
interface InputAdapter
{
    /**
     * リクエスト取得
     *
     * @param string $name
     * @return mixed
     */
    public function get(string $name);

    /**
     * リクエスト全権取得
     *
     * @return array
     */
    public function all(): array;
}
