<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>一覧</title>
        <meta name="description" content="一覧画面">
        <link rel="stylesheet" type="text/css" href="css/home.css">
    </head>
    <body>
        <?php
            require_once __DIR__.'/header.php';
        ?>
        <!--title list-->
        <div class="title">
            <b>記事のタイトル一覧</b>
        </div>

        <div class="button_summary">
            <button class="button" <!--onclick="location.href='detail.php'"--><!--ここに制作物のタイトル--></button><br><!--制作物のタイトル -->
            <button class="button" <!--onclick="location.href='detail.php'"--><!--ここに未解決の質問--></button><br><!--未解決の質問 -->
            <button class="button" <!--onclick="location.href='detail.php'"--><!--ここに解決済みの質問--></button><br><br><!--解決済みの質問 -->
        </div>

        <div class="number">
            <button>1</button>,
            <button>2</button>,
            <button>3</button>,
            <button>4</button>,
            <button>5</button>,・・・・・・
            <button>次へ</button>
        </div>
    </body>
</html>