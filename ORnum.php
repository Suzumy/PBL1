<?php
    //送られてきたデータを受け取る
    $answer = $_POST['answer'];
    $articleId = $_SESSION['articleId'];

    //userオブジェクトを生成する
    require_once __DIR__ . '/dbdata/dbsql.php';
    $user = new User();

    session_start();

    //空白消す
    $answer = preg_replace( '/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', $answer);
    //改行消す
    $answer = str_replace(array("\r\n","\n","\r"), '', $answer);

    $max_len = 160;
    $len = strlen($answer);

    //空白、改行、その他エラー判定
    if($answer == ''){
        $_SESSION['text_error'] = '入力してから送信ボタンを押してください。';
        header('Location: detail.php?data%5b%5d='+$articleId);
        exit();
    }

    //最大文字数エラー判定
    if($len > $max_len){
        $_SESSION['text_error'] = '最大文字数を超えています。';
        header('Location: detail.php?data%5b%5d='+$articleId);
        exit();
    }
    $ans_storage = $user->ans_storage($_SESSION['articleId'], $_SESSION['userId'], $answer);