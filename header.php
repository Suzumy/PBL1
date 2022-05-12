
<!DOCTYPE html> 
<html lang="ja">
<?php
    require_once __DIR__.'/pre.php';
?>
<head>
<meta charset="UTF-8">
</head>
<style>
    .main{
        /* background: linear-gradient(to right,
        #ffb7b7,
        #ffdbb7,
        #ffffb7,
        #b7ffb7,
        #b7ffff,
        #b7dbff,
        #dbb7ff)0/200%;

        animation: 5s main linear infinite; *//*ゲーミングパステルカラー用背景*/
        /* background: #d9ead3; */
        text-align: center;
        padding: 20px;
    }
    @keyframes main{
        100%{background-position: 200%;};/*ゲーミングパステルカラー用アニメーション*/
    }
    header_button{
        position: relative;
        margin: 0px 10px;
        padding: 5px 10px;
        background: linear-gradient(to right,
        #ffb7b7,
        #ffdbb7,
        #ffffb7,
        #b7ffb7,
        #b7ffff,
        #b7dbff,
        #dbb7ff)0/200%;
        animation: 5s button linear infinite; *//*ゲーミングパステルカラー用背景*/
        background: linear-gradient(to right,
        #d9ead3,
        #b7ffff)0/200%;
        animation: 5s header_button linear infinite;  
    }
    @keyframes header_button{
        100%{background-position: 200%;};/*ヘッダー用アニメーション*/
    }*/
    </style>
    
<body>
    <div class="main">
        <header_button onclick="location.href='post_item.php'">投稿</header_button>
        <header_button onclick="location.href='post_question.php'">質問投稿</header_button>
        <header_button onclick="location.href='home.php'">質問記事一覧</header_button> <!-- 記事一覧に改名するかもしれません、一旦保留--> 

        <header_button onclick="location.href='profile.php?userId%5b%5d=1'">プロフィール</header_button><!--？以降は取り合えず値を代入しています。ログイン機能が整えばuserIdを代入する予定-->

        <header_button onclick="location.href='login.php'">ログアウト</header_button>
    </div>
</body>
</html>