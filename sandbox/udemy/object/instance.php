<?php

class Product{
    //アクセス修飾子

    //変数
    private $product = [];

    function __construct($product){
        $this->product = $product;
    }

    public function getProduct(){
        echo $this->product;
    }

    public function addProduct($item){
        $this->product .= $item;
    }

    public static function getStaticProduct($str){
        echo $str;
    }
}

$instance = new Product('テスト');

var_dump($instance);

$instance->getProduct();
echo '<br>';

//親クラスのメソッド
// $instance->echoProduct();
// echo '<br>';


$instance->addProduct('追加分');
echo '<br>';

$instance->getProduct();
echo '<br>';

// $instance->getNews();
// echo '<br>';

//静的(static) クラス名::関数名
Product::getStaticProduct('静的');
echo '<br>';