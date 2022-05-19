<!DOCTYPE html>
<html>

<head>
    <title>投稿記事一覧</title>
    <link rel="stylesheet" type="text/css" href="css/detail.css">
</head>


<?php
session_start();
require_once __DIR__ . './header.php';
require_once __DIR__ . '/./dbdata/dbsql.php';
require_once __DIR__ . '/util.php';

$user = new User();
$data = $_GET['data'];
$users = $user->authUser($data[0]);
$_SESSION['articleId'] = $data[0];


$get_comment = $user->get_comment($_SESSION['articleId']);
?>

<body bgcolor="#d9ead3" style="padding: 20px 100px;">
    <table>
        <tr>

            <!--<p style="margin-right: 1000px"><img src=" images/<?= $users['articleimg1'] ?>"width="20" height="20"><?= $users['userName'] ?>-->

            <td>
                <img src=" images/<?= $users['imagepath'] ?>" alt="アイコン" width="20" height="20">
            </td>
            <td>
                <p><?= h($users['userName']) ?></p>
            </td>

            <!--             <p style="margin-right: 1000px"><img src=" images/<?= $users['articleimg1'] ?>" width="20" height="20"><?= $users['userName'] ?> -->

        </tr>
    </table>


    <ul style="list-style-type: circle;">
    </ul>

    <table style="border-collapse: collapse; width: 1045px; margin: 0 auto;" border="1">
        <tbody>
            <tr>
                <td style="width: 100%;">

                    <!--                     <p style="text-align: left; padding-left: 40px;"><?= $users['title'] ?></p>
                    <p style="text-align: left; padding-left: 40px;"><?= $users['explanation'] ?></p>
                    <img src=" images/<?= $users['articleimg1'] ?>" alt="アイコン" width="100" height="100">
                    <img src=" images/<?= $users['articleimg2'] ?>" alt="アイコン" width="100" height="100"> -->

                    <p style="text-align: left; padding-left: 40px;"><?= h($users['title']) ?></p>
                    <textarea disabled style="border: none; background-color: #d9ead3; color: inherit; width: 900px; height: 300px;" name=”テキストエリア” rows=”3″ cols=”50″ wrap=”hard”><?= h($users['explanation']) ?></textarea>
                    <!-- <img src=" images/<?= $users['articleimg1'] ?>" alt="アイコン" width="100" height="100">
                    <img src=" images/<?= $users['articleimg2'] ?>" alt="アイコン" width="100" height="100"> -->
                    <?php
                    for ($i = 1; $i <= 4; $i++) {
                        if ($users['articleimg' . $i] != null) {
                    ?>
                            <img src=" images/<?= $users['articleimg' . $i] ?>" width="100" height="100">
                    <?php
                        }
                    }
                    ?>
                    <br>
                    <br>
                    <?php
                    if ($users['urlpath'] != null) {
                    ?>
                        <a href="<?php echo $users['urlpath'] ?>"><?php echo h($users['urlpath']) ?></a>
                    <?php
                    }
                    ?>

                </td>
            </tr>
        </tbody>
    </table>
    <div class="button">
        <button>いいね！👍 999</button>
        <button>低評価👎 0</button>
    </div>

    <!-- <p style="margin-right: 1000px">コメント</p>

    <form method="POST" action="comment_db.php" target="sendPhoto">
        <textarea name="comment" style="width: 1045px; height: 300px;" cols="50" rows="1" maxlength="1000"></textarea> -->

    <!--     <textarea name="comment" style="width: 1045px; height: 300px;" cols="50" rows="1" maxlength="1000"></textarea> -->

    <!-- <div class="btn">
            <button class="Form-Btn pos" onclick="location.href='#'">送信</button>
        </div>
    </form>
    <iframe name="sendPhoto" style="width:0px;height:0px;border:0px;"></iframe> -->

    <?php
    if ($users['ORnum'] == 1) { //詳細が製作物の時
        $get_comment = $user->get_comment($_SESSION['articleId']);
    ?>
        <p style="margin-right: 1000px">コメント</p>
        <form method="POST" action="comment_db.php" target="sendPhoto">
            <textarea name="comment" style="width: 1045px; height: 300px;" cols="50" rows="1" maxlength="1000"></textarea>
            <div class="btn">
                <button class="Form-Btn pos" onclick="location.href='#'">送信</button>
            </div>
        </form>
        <iframe name="sendPhoto" style="width:0px;height:0px;border:0px;"></iframe>
        <?php foreach ($get_comment as $row) { //コメント表示
        ?>
            <section>
                <button onclick="location.href='detail.php?data%5b%5d=<?= $row['articleId'] ?>'" target='_blank' class='btn_ao_a'>
                    <span class="a__icon">
                        <img width="20px" src="./images/<?= $row['imagepath'] ?>" alt="<?= $row['userName'] ?>">
                    </span>
                    <span>
                        <a id="nametag" href="profile.php"><?= $row['userName'] ?></a>
                    </span>
                </button>
                <span class="comment">
                    <?= h($row['comment']) ?>
                </span>
            </section>
        <?php
        }
    }
    if ($users['ORnum'] == 2) { //詳細が質問のとき
        $_SESSION['ORnum'] = $users['ORnum'];
        $get_answers = $user->get_answers($_SESSION['articleId']); ?>
        <p style="margin-right: 1000px">質問回答</p>
        <form method="POST" action="ORnum.php" target="sendPhoto">
            <textarea name="answer" style="width: 1045px; height: 300px;" cols="50" rows="1" maxlength="1000"></textarea>
            <div class="btn">
                <button class="Form-Btn pos" onclick="location.href='#'">送信</button>
            </div>
        </form>
        <iframe name="sendPhoto" style="width:0px;height:0px;border:0px;"></iframe>
        <?php
        foreach ($get_answers as $row) { //コメント表示
        ?>
            <section>
                <button onclick="location.href='detail.php?data%5b%5d=<?= $row['articleId'] ?>'" target='_blank' class='btn_ao_a'>
                    <span class="a__icon">
                        <img width="20px" src="./images/<?= $row['imagepath'] ?>" alt="<?= $row['userName'] ?>">
                    </span>
                    <span>
                        <a id="nametag" href="profile.php"><?= $row['userName'] ?></a>
                    </span>999
                </button>
                <span class="answer">
                    <?= h($row['answer']) ?>
                </span>

            </section>
    <?php
        }
    }
    ?>
    <!--     foreach ($get_comment as $row) { //コメント表示
    ?>

        <section>
            <button onclick="location.href='detail.php?data%5b%5d=<?= $row['articleId'] ?>'" target='_blank' class='btn_ao_a'>
                <span class="a__icon">
                    <img width="20px" src="./images/<?= $row['imagepath'] ?>" alt="<?= $row['userName'] ?>">
                </span>
                <span>
                    <a id="nametag" href="profile.php"><?= $row['userName'] ?></a>
                </span>
            </button>
            <span class="comment">
                <?= h($row['comment']) ?>
            </span>

        </section>
    <?php #} 
    ?> -->
</body>