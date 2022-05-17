<?php

//DB接続設定
$dsn = 'mysql:host=localhost;dbname=PBL1;charset=utf8';
$user = 'PBL1A';
$password = 'password';

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (Exception $e) {
    echo 'Error' . $e->getMessage();
    die();
}
