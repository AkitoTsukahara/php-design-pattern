<?php

class User
{
    protected $phone;

    public function __construct()
    {
        // インスタンスの生成方法を登録する
        app()->bind('Phone', function(){
            return new Phone();
        });

        // サービスコンテナが生成したインスタンスを取得
        $this->phone = app()->make('Phone');

    }

    public function userCallPhone()
    {
        $this->phone->call();
    }
}

class Phone
{
    public function call()
    {
        return "プルプル。。。";
    }
}

$user = new User();