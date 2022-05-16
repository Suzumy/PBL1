<!DOCTYPE html> 
<html lang="ja">
<?php
    require_once __DIR__.'/pre.php';
?>
<head>
<meta charset="UTF-8">
</head>
<style>
    /* .main{
        text-align: center;
        padding: 20px;
    } */

    /*header_button{
            margin: 0px 10px;
            padding: 5px 10px;
    } */
    .header_button {
        margin: -10px -10px 20px -10px; 
        padding: 20px 0px 30px 100px ;  
        text-align: center;
        background: /*#b2ffd8*/ #ffdbb7;
        white-space: nowrap;
        /* background: linear-gradient(to right,
        #ffb7b7,
        #ffdbb7,
        #ffffb7,
        #b7ffb7,
        #b7ffff,
        #b7dbff,
        #dbb7ff)0/200%;
        animation: 5s header_button linear infinite; */ /*虹色アニメーション用 */

    }

    .header_button header_btn{
        display: inline-block;
        margin: 0px 35px 0px 35px;
        padding: 10px 10px;
        font-size: 20px;
    }

    .header_button :hover{
        border: 1px solid #333; 
        background: linear-gradient(to right, #b7ffff, #b7dbff
        )0/200%; 
        animation: 1s header_button linear infinite;
    }
    @keyframes header_button{
        100%{background-position: 200%;};
    }
    </style>
    
<body>
    <div class="header_button">
        <header_btn onclick="location.href='post_item.php'"><b>投稿</b></header_btn>|
        <header_btn onclick="location.href='post_question.php'"><b>質問投稿</b></header_btn>|
        <header_btn onclick="location.href='home.php'"><b>質問記事一覧</b></header_btn>| <!-- 記事一覧に改名するかもしれません、一旦保留--> 
        <header_btn onclick="location.href='profile.php?userId%5b%5d=1'"><b>プロフィール</b></header_btn>|<!--？以降は取り合えず値を代入しています。ログイン機能が整えばuserIdを代入する予定-->
        <header_btn onclick="location.href='login.php'"><b>ログアウト</b></header_btn>
    </div>
</body>