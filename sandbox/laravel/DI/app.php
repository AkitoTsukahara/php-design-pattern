<?php

// Applicationクラスのインスタンスを作成
$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

// カーネルのインターフェース名を実際のクラス名に紐付けてます
// ひも付けているだけで実際に作られるのはmakeされる時。
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class, // こっちがインタフェース
    App\Http\Kernel::class // 実クラス
);
$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

return $app;