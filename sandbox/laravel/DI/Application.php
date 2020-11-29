<?php

class Application{

    public function __construct($basePath = null)
    {
        // 1.自分自身($this)を自分のDIコンテナに登録します。
        $this->registerBaseBindings();

        // 2.必ず必要になるServiceProviderを登録しています。（Event,Routing）
        $this->registerbaseServiceProviders();
        // $this->register(new EventServiceProvider($this));
        // $this->register(new RoutingServiceProvider($this));


        // 3.DIコンテナにLaravel本体のコア機能の情報を登録しています。
        // ただし、ここでは名前のひも付けを登録しているだけで実際のコンテナ登録はServiceProviderが対応します。
        $this->registerCoreContainerAliases();

        if ($basePath) {
            // 4.pathを取得できる様にpathの登録を一括で行います。
            // これもDIコンテナにインスタンス（実際は文字列）を登録しています。
            $this->setBasePath($basePath);
        }
    }


    /**
     * Resolve the given type from the container.
     *
     * @param  string  $abstract
     * @param  array   $parameters
     * @return mixed
     */
    public function make($abstract, $parameters = [])
    {
        // aliasesに$abstractのキーがあれば、その値(binding名)、無かったらそのまま$abstractを返します
        // 例えば、Illuminate\Events\Dispatcherが渡された時、eventsという文字列が返されます。
        $abstract = $this->getAlias($this->normalize($abstract));

        // すでにインスタンスが存在する場合はそれを返す(singletonやbindSharedで2回目以降等)
        if (isset($this->instances[$abstract]))
        {
            return $this->instances[$abstract];
        }

        // 依存関係の先の内容を取得します。
        // メソッドの返り値は基本的にクロージャーですが、バインディングが登録されてない場合等はそのままabstractが返ります。
        // 先ほどのeventsの場合は、bindメソッドで登録をしているクロージャーが返ってきます。
        $concrete = $this->getConcrete($abstract);

        // build出来るかどうか。concreteがクロージャーだった場合や、abstractとconcreteが同じ場合。
        if ($this->isBuildable($concrete, $abstract))
        {
            // 求めているオブジェクトを返却します。クロージャーの場合はクロージャーを発火させた後の値が入ります。
            // ここでコンストラクタインジェクションが解決されます。
            $object = $this->build($concrete, $parameters);
        }
        else
        {
            // 違う場合は再度makeします。(多分ネストされてる時？)
            $object = $this->make($concrete, $parameters);
        }

        // extenderが存在すれば、それを適用させます。
        foreach ($this->getExtenders($abstract) as $extender)
        {
            $object = $extender($object, $this);
        }

        // singleton等、共有する必要がある場合はinstancesに登録しておきます。
        if ($this->isShared($abstract))
        {
            $this->instances[$abstract] = $object;
        }

        // resolvingを発火させます。
        $this->fireResolvingCallbacks($abstract, $object);

        // 対象を解決済みにします。
        $this->resolved[$abstract] = true;

        return $object;
    }
}