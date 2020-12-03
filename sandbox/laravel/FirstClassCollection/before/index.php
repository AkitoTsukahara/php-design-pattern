<?php

$books = $bookRepository->getList();

//価格を表示
$sumPrice = 0;
foreach ($books as $book) {
    $sumPrice += $book->getPrice();
}

$view->print($sumPrice);

//リストを表示
foreach ($books as $book) {
    $view->print($book->getTitle());
    $view->print($book->getPrice());
}