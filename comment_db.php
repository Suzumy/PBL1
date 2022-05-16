<?php
 //送られてきたデータを受け取る
 $comment = $_POST['comment'];

 //Userオブジェクトを呼び出し、comment_storage()を実行する
 require_once __DIR__ .'/dbdata/dbsql.php';
 $user = new User();
 
 session_start();
 //DBにコメント、記事ID、ユーザーIDを登録する
 $comment_storage = $user->comment_storage($_SESSION['articleId'], $_SESSION['userId'], $comment);