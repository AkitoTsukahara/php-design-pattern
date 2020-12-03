<?php

$bookList = $bookRepository->getList();

//価格を表示
$view->print($bookList->getSumPrice());

//リストを表示
foreach ($bookList as $book) {
    $view->print($book->getTitle());
    $view->print($book->getPrice());
}