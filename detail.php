<?php

    session_start();
    require_once __DIR__ . './header.php';
    require_once __DIR__.'/./dbdata/dbsql.php';
    $user = new User();

    $data = $_GET['data'];

    $users = $user->authUser($data[0]);
?>
<head>
    <title>投稿記事一覧</title>
    <link rel="stylesheet" type="text/css" href="css/detail.css">
</head>
<html>
<body bgcolor="#d9ead3" style="padding: 20px 100px;">
    <table>
        <tr>
            <p style="margin-right: 1000px"><img src=" images/<?= $users['articleimg1'] ?>"width="20" height="20"><?= $users['userName'] ?>
        </tr>
    </table>

    
    <ul style="list-style-type: circle;">
    </ul>
    
    <table style="border-collapse: collapse; width: 1045px; margin: 0 auto;" border="1">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: left; padding-left: 40px;"><?= $users['title'] ?></p>
                    <textarea disabled style="border: none; background-color: #d9ead3; color: inherit; width: 900px;" name=”テキストエリア” rows=”3″ cols=”50″ wrap=”hard” ><?= $users['explanation'] ?></textarea>
                    <img src=" images/<?= $users['articleimg1'] ?>" alt="アイコン" width="100" height="100">
                    <img src=" images/<?= $users['articleimg2'] ?>" alt="アイコン" width="100" height="100">
                </td>
            </tr>
        </tbody>
    </table>
    <div class="button">
        <button>いいね！👍</button>
        <button>低評価👎</button>
    </div>
    </div>
    <textarea name="comment" style="width: 1045px; height: 300px;" cols="50" rows="1" maxlength="1000"
    placeholder="コメントを入力"></textarea>
    <div class="btn">
        <button class="button2" onclick="location.href='#'">送信</button>
    </div>
    </form>
    <iframe name="sendPhoto" style="width:0px;height:0px;border:0px;"></iframe>

    <?php
        foreach($get_comment as $row){//コメント表示
    ?>

    <section>
        <button onclick="location.href='detail.php?data%5b%5d=<?= $row['articleId']?>'" target='_blank' class='btn_ao_a'>
            <span class="a__icon">
                    <img width="20px" src="./images/<?= $row['imagepath'] ?>" alt="<?= $row['userName'] ?>">
            </span>
            <span>
                <a id="nametag" href="profile.php"><?= $row['userName'] ?></a>
            </span>
        </button>
            <span class="comment">
                <?= $row['comment'] ?>
            </span>
        
    </section>
    <?php } ?>
</body>

</html>