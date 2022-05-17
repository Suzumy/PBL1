<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="ヘッダー">
    <link rel="stylesheet" type="text/css" href="css/header.css">
</head>

<body>
    <?php
    require_once __DIR__ . '/pre.php';
    ?>
    <div class="header_button">
        <header_btn onclick="location.href='post_item.php'"><b>投稿</b></header_btn>|
        <header_btn onclick="location.href='post_question.php'"><b>質問投稿</b></header_btn>|
        <header_btn onclick="location.href='home.php'"><b>質問記事一覧</b></header_btn>|
        <!-- 記事一覧に改名するかもしれません、一旦保留-->
        <header_btn onclick="location.href='profile.php?userId%5b%5d=1'"><b>プロフィール</b></header_btn>|
        <!--？以降は取り合えず値を代入しています。ログイン機能が整えばuserIdを代入する予定-->
        <header_btn onclick="location.href='login.php'"><b>ログアウト</b></header_btn>
    </div>
</body>