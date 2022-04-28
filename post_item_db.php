<!-- ページをもとに戻す処理 -->
<script type="text/javascript">
    document.location.href = "post_item.php";
</script>

<?php

require_once __DIR__ . './dbdata.php';
$title = $_POST['title'];
$explanation = $_POST['explanation'];
$arti = [null, null, null, null];

//画像受け取り
if (!empty($_FILES)) {
    for ($i = 0; $i < count($_FILES['upload_img']['name']); $i++) {
        $filename = $_FILES['upload_img']['name'][$i];
        $uploded_path = 'img_after/' . $filename;
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
$post->post_article($title, $explanation, $arti[0], $arti[1], $arti[2], $arti[3], $urlpath);
