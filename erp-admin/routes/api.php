<?php
// ログイン
Route::middleware(['logger:api'])->post('auth/login', Auth\Login\Action::class);

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
    });
    // 従業員情報
    Route::prefix('employee')->group(function () {
        // 全ユーザー取得処理
        Route::get('fetch/all', Employee\FetchAll\Action::class);
        // ユーザー別情報履歴取得処理
        Route::get('fetch/profile/history', Employee\FetchProfileHistory\Action::class);
        // ユーザー別情報取得処理
        Route::get('fetch/profile/detail', Employee\FetchProfileDetail\Action::class);
        // 従業員登録処理
        Route::post('store/member', Employee\Store\Action::class);
        // 更新処理
        Route::post('update/profile', Employee\Update\Action::class);
        // 更新処理
        Route::delete('delete/user', Employee\Delete\Action::class);
        // 参考csvダウンロード処理
        Route::get('download/example', Employee\CsvDownloadExample\Action::class);
    });

    // 交通費情報
    Route::prefix('fare')->group(function () {
        // 画像取得処理
        Route::get('img', Fare\FetchImg\Action::class);
        // 全ユーザー取得処理
        Route::get('fetch/all', Fare\FetchTargetMonth\Action::class);
        // ユーザー別取得処理
        Route::get('fetch/detail', Fare\FetchTargetMonthDetail\Action::class);
        // 更新処理
        Route::post('update', Fare\Update\Action::class);
        // 削除処理
        Route::delete('delete', Fare\Delete\Action::class);
    });
});
