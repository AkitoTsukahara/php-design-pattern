<?php

//1.オートロードファイルを読み込む
require __DIR__.'/../bootstrap/autoload.php';

//2.Applicationクラスのインスタンスを生成。各種カーネルクラスの登録作業。
$app = require_once __DIR__.'/../bootstrap/app.php';

//3.HTTPカーネルをサービスコンテナから作成
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

//4.HTTPカーネルにRequestを渡してResponseをもらう
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

//5.Responseヘッダーのセットと、レスポンス内容をechoする
$response->send();

//6.Middlewareのterminateを実行と各種terminate時のコールバックを実行
$kernel->terminate($request,$response);