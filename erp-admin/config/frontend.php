<?php
/**
 * フロントエンドの設定ファイル
 */

return [
    //フロントエンドのスタッフ側のドメイン
    'frontend_staff_domain'         => env('FRONTEND_STAFF_URL', 'http://staff.irnak.local'),
    // スタッフのパスワード初期設定
    'staff_password_generate'   => env('STAFF_PASSWORD_GENERATE', '/password/generate?token='),
];
