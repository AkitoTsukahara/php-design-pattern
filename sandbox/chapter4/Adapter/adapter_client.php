<?php
require_once 'DisplaySourceFileImpl.class.php';
require_once 'DisplaySourceFileImpl0.class.php';

/**
 * DisplaySourceFileImplクラスをインスタンス化する
 * 内容を表示するファイルは、「ShowFile.class.php」
 */
$show_file = new DisplaySourceFileImpl('./ShowFile.class.php');

/**
 * プレーンテキストとハイライトしたファイル内容をそれぞれ表示する
 */
$show_file->display();


echo '<hr>';


/**
 * DisplaySourceFileImplクラスをインスタンス化する
 * 内容を表示するファイルは、「ShowFile.class.php」
 */
$show_file = new DisplaySourceFileImpl0('./ShowFile.class.php');

/**
 * プレーンテキストとハイライトしたファイル内容をそれぞれ表示する
 */
$show_file->display();
