<?php
    //送られてきたデータを受け取る
    $comment = $_POST['comment'];
    $articleId = $_SESSION['articleId'];

    //userオブジェクトを生成する
    require_once __DIR__ . '/dbdata/dbsql.php';
    $user = new User();

    session_start();

    //空白消す
    $comment = preg_replace( '/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', $comment);
    //改行消す
    $comment = str_replace(array("\r\n","\n","\r"), '', $comment);

    //$max_len = 160;
    //$len = strlen($comment);

    //空白、改行、その他エラー判定
    if($comment == ''){
        $_SESSION['text_error'] = '入力してから送信ボタンを押してください。';
        header('Location: detail.php?data%5b%5d='+$articleId);
        exit();
    }

    //最大文字数エラー判定
    // if($len > $max_len){
    //     $_SESSION['text_error'] = '最大文字数を超えています。';
    //     header('Location: detail.php?data%5b%5d='+$articleId);
    //     exit();
    // }

    if($_SESSION['ORnum'] == 1){
        $comment_storage = $user->comment_storage($_SESSION['articleId'], $_SESSION['userId'], $comment);
    }elseif($_SESSION['ORnum'] == 2){
        $ans_storage = $user->ans_storage($_SESSION['articleId'], $_SESSION['userId'], $comment);
    }