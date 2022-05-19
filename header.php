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
        <div class="header_btn" onclick="location.href='post_item.php'"><b>記事投稿</b></div>|
        <div class="header_btn" onclick="location.href='post_question.php'"><b>質問投稿</b></div>|
        <div class="header_btn" onclick="location.href='home.php'"><b>投稿物一覧</b></div>|
        <!-- 記事一覧に改名するかもしれません、一旦保留-->
        <div class="header_btn" onclick="location.href='profile.php?userId%5b%5d=1'"><b>プロフィール</b></div>|
        <!--？以降は取り合えず値を代入しています。ログイン機能が整えばuserIdを代入する予定-->
        <div class="header_btn"  onclick="location.href='login.php'"><b>ログアウト</b></div>
    </div>
</body>