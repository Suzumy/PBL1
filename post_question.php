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

        <form method="POST" action="./post_question_db.php">
            <h1>～ 質問投稿 ～</h1>
            <p style="margin-right: 650px"><span class="Form-Item-Label-Required">必須</span></p>
            <input type="text" name="title" class="Form-Item-Input"
            placeholder="例）タイトル" required>
            <p style="margin-right: 650px"><span class="Form-Item-Label-Required">必須</span></p>
            <textarea name="textarea" cols="50" rows="10" maxlength="400"
            placeholder="例）質問文（４００文字以下）" required></textarea>
            <p style="margin-right: 570px">📷 <a href="#">写真を追加</a></p>
            <input type="submit" name="button1" value="投稿する">
        </form>
    </body>
</html>