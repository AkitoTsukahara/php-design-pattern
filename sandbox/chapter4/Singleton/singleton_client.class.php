<?php
require_once 'SingletonSample.class.php';

/**
 * インスタンスを2つ取得する
 */
$instance1 = Singletonsample::getInstance();
sleep(1);
$instance2 = Singletonsample::getInstance();

echo '<hr>';

/**
 * 2つのインスタンスが同一IDかどうか確認する
 */
echo 'instance ID : ' . $instance1->getID() . '<br>';
echo '$instance1->getID() === $instance2->getID() : ' . ($instance1->getID() === $instance2->getID() ? 'true' : 'false');
echo '<hr>';

/**
 * 2つのインスタンスが同一かどうか確認する
 */
echo '$instance1 === $instance2 : ' . ($instance1 === $instance2 ? 'true' : 'false');
echo '<hr>';

/**
 * 複製できないことを確認する
 */
$instance1_clone = clone $instance1;