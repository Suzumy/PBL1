<?php
session_start();

require_once __DIR__ . './dbdata/dbdata.php';
$title = $_POST['title'];
$explanation = $_POST['explanation'];
$arti = [null, null, null, null];
$userId = $_SESSION['userId'];

//画像受け取り
if (!empty($_FILES)) {
    for ($i = 0; $i < count($_FILES['upload_img']['name']); $i++) {
        $filename = $_FILES['upload_img']['name'][$i];
        $uploded_path = 'images/' . $filename;
        $result = move_uploaded_file($_FILES['upload_img']['tmp_name'][$i], $uploded_path);
        $arti[$i] = $filename;
    }
} else {
    var_dump("error");
}
$urlpath = $_POST['urlpath'];

//クラスを呼び出し、制作物記事をDBに登録する
require_once __DIR__ . './post.php';
$post = new Post();
$ornum = $_POST['ornum']; #ornumの値を設定。記事投稿なら1、質問投稿なら2とする
$post->post_article($userId, $title, $explanation, $arti[0], $arti[1], $arti[2], $arti[3], $urlpath, $ornum);

//ページをもとに戻す処理
if ($ornum == 1) {
    $send_url = 'post_item.php';
} else {
    $send_url = 'post_question.php';
}

echo "<script> document.location.href = '$send_url' </script>";