
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
        background: linear-gradient(to right,
        #ffb7b7,
        #ffdbb7,
        #ffffb7,
        #b7ffb7,
        #b7ffff,
        #b7dbff,
        #dbb7ff)0/200%;
        text-align: center;
        padding: 20px;
        animation: 5s main linear infinite;
    }
    @keyframes main{
        100%{background-position: 200%;};
    }
    button{
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
        animation: 5s button linear infinite;
    }
    @keyframes button{
        100%{background-position: 200%;};
    }
    </style>
    
<body>
    <div class="main">
        <button onclick="location.href='post_item.php'">投稿</button>
        <button onclick="location.href='post_question.php'">質問投稿</button>
        <button onclick="location.href='home.php'">質問記事一覧</button> <!-- 記事一覧に改名するかもしれません、一旦保留--> 

        <button onclick="location.href='profile.php?userId%5b%5d=1'">プロフィール</button><!--？以降は取り合えず値を代入しています。ログイン機能が整えばuserIdを代入する予定-->

        <button onclick="location.href='login.php'">ログアウト</button>
    </div>
</body>
</html>