<?php
require_once __DIR__ . '/header.php';
?>

<head>
    <meta charset="UTF-8">
    <title>投稿フォーム</title>
    <link rel="stylesheet" href="css/post_item.css">
</head>
<html>

<body>
    <form method="POST" action="./post_item_db.php" enctype="multipart/form-data">
        <div class="post">
            <div class="Form">
                <p>投稿フォーム</p>
                <div class="Form-Item">
                    <p class="Form-Item-Label">
                        <span class="Form-Item-Label-Required">必須</span>
                    </p>
                    <input type="text" name="title" class="Form-Item-Input" placeholder="例）タイトル" required>
                </div>
                <div class="Form-Item">
                    <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span></p>
                    <textarea name="explanation" class="Form-Item-Textarea" placeholder="例）説明文" required></textarea>
                </div>
                <div class="Form-Item">
                    <p>画像のアップロードは<br>4枚までです</p>
                    <input type="file" name="upload_img[]" multiple>
                </div>
                <div class="Form-Item">
                    <p class="Form-Item-Label">
                        <span class="Form-Item-Label-Required">必須</span>
                    </p>
                    <input type="text" name="urlpath" class="Form-Item-Input" placeholder="例）ハッシュタグ" required>
                </div>
                <hr>
                <div class="btn">
                    <input class="Form-Btn can" type="reset" value="キャンセル">
                    <input class="Form-Btn pos" type="submit" value="投稿">
                </div>
            </div>
        </div>
    </form>
</body>

</html>