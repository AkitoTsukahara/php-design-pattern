<?php

class User
{
    protected $phone;

    public function __construct()
    {
        //Userクラスの中でPhoneクラスを呼び出している
        //これだと依存度が高くなってしまう
        $this->phone = new Phone();
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

$user = new User($phone);