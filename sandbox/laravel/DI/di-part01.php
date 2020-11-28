<?php

class User
{
    protected $phone;

    public function __construct(Phone $phone)
    {
        $this->phone = $phone;
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

// ここでPhoneクラスをインスタンス化
$phone = new Phone();

// Phoneクラスのインスタンスを引数に渡す
// UserクラスとPhoneクラスの疎結合に成功！
$user = new User($phone);