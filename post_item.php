<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>記事投稿フォーム</title>
    <meta name="description" content="記事投稿画面">
    <link rel="stylesheet" href="css/post_form.css">
</head>
<script>
    
</script>
<body>
    <?php
    require_once __DIR__ . '/header.php';
    ?>
    <form method="POST" action="./post_form_db.php" enctype="multipart/form-data">
        <div class="post">
            <div class="Form">
                <h1>記事投稿フォーム</h1>
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
                        <span class="Form-Item-Label-No">任意</span>
                    </p>
                    <input type="text" name="urlpath" class="Form-Item-Input" placeholder="例）URL">
                </div>
                <hr>
                <div class="btn">
                    <input class="Form-Btn" type="reset" value="キャンセル">
                    <input class="Form-Btn" type="submit" value="投稿">
                </div>
                <br>
            </div>
        </div>
        <input type='hidden' name='ornum' value='1'>
    </form>
</body>

</html>