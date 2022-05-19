<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>プロフィール編集画面</title>
    <meta name="description" content="プロフィール編集画面">
    <link rel="stylesheet" type="text/css" href="css/post_form.css">
</head>

<body>
    <?php
    require_once __DIR__ . '/header.php';
    ?>
    <form method="POST" action="#">
        <div class="post">
            <div class="Form">
                <h1>プロフィール編集</h1>
                <div class="Form-Item">
                    <p>プロフィール画像のアップロードは<br>１枚までです</p>
                    <input type="file" name="upload_img[]" multiple>
                </div>
                <div class="Form-Item">
                    <p class="Form-Item-Label">
                        <span class="Form-Item-Label-Required">必須</span>
                    </p>
                    <input type="text" name="username" class="Form-Item-Input" maxlength="20" placeholder="例）名前（２０文字以下）" required>
                </div>
                <div class="Form-Item">
                    <p class="Form-Item-Label">
                        <span class="Form-Item-Label-Required">必須</span>
                    </p>
                    <select class="userYear">
                        <option value="1">1年生</option>
                        <option value="2">2年生</option>
                        <option value="3">3年生</option>
                        <option value="4">4年生</option>
                    </select>
                </div>
                <div class="Form-Item">
                    <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span></p>
                    <input type="text" name="userDepartment" class="Form-Item-Input" maxlength="50" placeholder="例）学科名（５０字以下）" required>
                </div>
                <hr>
                <div class="btn">
                    <input class="Form-Btn" type="reset" value="キャンセル">
                    <input class="Form-Btn" type="submit" value="完了">
                </div>
            </div>
        </div>
    </form>
</body>

</html>