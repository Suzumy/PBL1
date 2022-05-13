<!-- ページをもとに戻す処理 -->
<script type="text/javascript">
    document.location.href = "post_item.php";
</script>

<?php

session_start();

$title = $_POST['title'];
$textarea = $_POST['textarea'];
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

//クラスを呼び出し、制作物記事をDBに登録する
require_once __DIR__ . './post.php';
$post = new Post();
$ornum = 2; #ornumの値を設定。記事投稿なら1、質問投稿なら2とする
$post->post_article($userId, $title, $textarea, $arti[0], $arti[1], $arti[2], $arti[3], null, $ornum);
