<?php
//送られてきたデータを受け取る
$answer = $_POST['answer'];
session_start();
$ORnum =  $_SESSION['ORnum'];

//userオブジェクトを生成する
require_once __DIR__ . '/dbdata/dbsql.php';
$user = new User();

$ans_storage = $user->ans_storage($_SESSION['articleId'], $_SESSION['userId'], $answer);
