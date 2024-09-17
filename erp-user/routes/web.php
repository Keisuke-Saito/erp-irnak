<?php
// Route::get('/test', Base\testAction::class);
if (env('APP_ENV') !== 'production') {
    Route::get('/phpinfo', function () {
        echo '課題用';
        return phpinfo();
    });
}
Route::any('{all}', function () {
    return view('app');
})->where(['all' => '.*']);
