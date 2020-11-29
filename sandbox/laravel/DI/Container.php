<?php

class Container{

    // 省略

    public function bind($abstract, $concrete = null, $shared = false)
    {
        // 必要ない文字列を削ったりして返しています。
        $abstract = $this->normalize($abstract);
        $concrete = $this->normalize($concrete);

        // 配列になっていたらaliasに登録する
        if (is_array($abstract)) {
            list($abstract, $alias) = $this->extractAlias($abstract);
            $this->alias($abstract, $alias);
        }

        // すでに$abstractのキーでインスタンスがあったり
        // エイリアスがある場合はそれをunsetします
        // ここで言うと、eventsという名前で用意がすでにされていた場合はunsetします
        $this->dropStaleInstances($abstract);

        if (is_null($concrete)) {
            $concrete = $abstract;
        }

        // クロージャーではない(つまり文字列)であればクロージャーにする。
        // $abstractと$concreteが別名であれば、コンテナのmakeメソッド、
        // 同じであればbuildメソッドを呼び出すクロージャーを返します。
        if (! $concrete instanceof Closure) {
            $concrete = $this->getClosure($abstract, $concrete);
        }

        // bindingsにabstract(events)を登録します
        $this->bindings[$abstract] = compact('concrete', 'shared');

        // すでに依存解決されていた場合
        if ($this->resolved($abstract)) {
            // 再度インスタンスを登録する処理が走ります。
            // なぜこれを呼ぶかといえば、依存解決されていた場合は
            // 以前のインスタンスが返されてしまうので
            // 登録した内容を発火させてインスタンスを入れておく必要があるからです
            $this->rebound($abstract);
        }
    }
}