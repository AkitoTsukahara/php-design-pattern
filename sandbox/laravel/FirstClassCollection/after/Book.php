<?php

class Book {
    private $title;
    private $price;
    // ...


    //変更前
    ///** @return Book[] */
    //public function getList() : array

    //変更後
    //public function getList() : BookList

}