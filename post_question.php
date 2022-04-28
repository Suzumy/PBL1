<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>質問投稿画面</title>
        <meta name="description" content="質問投稿画面">
        <link rel="stylesheet" type="text/css" href="css/post_question.css">
    </head>
    <body>
        <?php 
            require_once __DIR__ . '/header.php'; 
        ?>
        <h1>～ 質問投稿 ～</h1>
        <p style="margin-right: 640px">質問文</p>
        <textarea name="example" cols="50" rows="10" maxlength="400" placeholder="４００文字以下で入力してください"></textarea>
        <p style="margin-right: 570px">📷 <a href="#">写真を追加</a></p>
        <input type="submit" name="button1" value="投稿する">
    </body>
</html>