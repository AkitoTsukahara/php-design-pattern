<?php
require_once 'ShowFile.class.php';

/**
 * ShowFileクラスをインスタンス化する
 * 内容を表示するファイルは、「ShowFile.class.php」
 */
try{
    $show_file = new ShowFile('./ShowFile.class.php');
}
catch (Exception $e){
    die($e->getMessage());
}

/**
 * プレーンテキストとハイライトしたファイル内容をそれぞれ表示する
 */
$show_file->showPlain();
echo '<hr>';
$show_file->showHighlight();