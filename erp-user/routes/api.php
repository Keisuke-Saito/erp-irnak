<?php
// 認証前
Route::middleware(['logger:api'])->group(function () {
    // 認証情報
    Route::prefix('auth')->group(function () {
        // ログイン
        Route::post('login', Auth\Login\Action::class);
        // トークンチェック
        Route::post('check/token', Auth\CheckCreateUserToken\Action::class);
        // ユーザー作成
        Route::post('create/user', Auth\CreateUser\Action::class);
    });
});

// 認証後
Route::middleware(['auth:api', 'logger:api'])->group(function () {
    // アプリ全体
    Route::prefix('common')->group(function () {
        // 一般マスタ情報取得処理
        Route::get('mst', Common\FetchCommonMst\Action::class);
    });
    // 認証情報
    Route::prefix('auth')->group(function () {
        // ログアウト
        Route::delete('logout', Auth\Logout\Action::class);
        // プロフィール情報取得
        Route::get('profile', Auth\GetUserInfo\Action::class);
    });

    // 交通費情報
    Route::prefix('fare')->group(function () {
        // 画像取得処理
        Route::get('img', Fare\FetchImg\Action::class);
        // 履歴取得処理
        Route::get('show/hisotry', Fare\ShowHistory\Action::class);
        // 確定処理
        Route::patch('confirm', Fare\Confirm\Action::class);
        // 新規追加処理
        Route::post('store', Fare\Store\Action::class);
        // 更新処理
        Route::post('update', Fare\Update\Action::class);
        // 削除処理
        Route::delete('delete', Fare\Delete\Action::class);
    });
});
