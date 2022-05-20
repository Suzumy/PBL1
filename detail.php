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
require_once __DIR__ . '/url.php';

$user = new User();
$data = $_GET['data'];
$users = $user->authUser($data[0]);
$_SESSION['articleId'] = $data[0];


$get_comment = $user->get_comment($_SESSION['articleId']);
?>

<body>
    <table>
        <tbody>
            <tr>
                <td>
                    <p class="username"><img src=" images/<?= $users['imagepath'] ?>" alt="アイコン" width="20" height="20"><?= h($users['userName']) ?></p>
                </td>
            </tr>
            <tr>
                <td class="border">
                    <!-- タイトル部分　-->
                    <p><?= h($users['title']) ?></p>
                    <!-- 本文 -->
                    <textarea name=”テキストエリア” class="user_text" cols=”50″ rows=”5″ disabled><?= h($users['explanation']) ?></textarea>
                    <!-- 画像表示処理 -->
                    <?php
                    for ($i = 1; $i <= 4; $i++) {
                        if ($users['articleimg' . $i] != null) {
                    ?>
                            <img src=" images/<?= $users['articleimg' . $i] ?>" width="100" height="100">
                    <?php
                        }
                    }
                    ?>
                    <!-- URL表示処理 -->
                    <?php if (h($users['urlpath']) != null) { ?>
                        <a href="<?php echo $users['urlpath'] ?>"><?php echo h($users['urlpath']) ?></a>
                    <?php } ?>
                    <!-- 評価ボタン -->
                    <div class="button">
                        <button>いいね！👍 999</button>
                        <button>低評価👎 0</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <hr>

    <?php
    if ($users['ORnum'] == 1) { //詳細が製作物の時
        $get_comment = $user->get_comment($_SESSION['articleId']);
    ?>
        <table>
            <tbody>
                <tr>
                    <td>
                        <p>コメント</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form method="POST" action="comment_db.php" target="sendPhoto">
                            <textarea name="comment" cols="50" rows="5" maxlength="1000"></textarea>
                            <div class="button">
                                <button class="Form-Btn" onclick="location.href='#'">送信</button>
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>

        <hr>

        <iframe name="sendPhoto"></iframe>
        <?php
        foreach ($get_comment as $row) { //コメント表示
            $url_param = url_param_change(array("userId" => $row['userId']))
        ?>
            <section>
                <button onclick="location.href='transition_profile.php?<?php echo $url_param; ?>'" target='_blank' class='btn_ao_a'>
                    <span class="a__icon">
                        <img width="20px" src="./images/<?= $row['imagepath'] ?>" alt="<?= h($row['userName']) ?>">
                    </span>
                    <span>
                        <a id="nametag"><?= h($row['userName']) ?></a>
                    </span>
                </button>
                <span class="comment">
                    <?= h($row['comment']) ?>
                </span>
            </section>
        <?php
        }
        ?>
        
    <?php
    }
    if ($users['ORnum'] == 2) { //詳細が質問のとき
        $_SESSION['ORnum'] = $users['ORnum'];
        $get_answers = $user->get_answers($_SESSION['articleId']); ?>
        <table>
            <tbody>
                <tr>
                    <td>
                        <p>質問回答</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form method="POST" action="ORnum.php" target="sendPhoto">
                            <textarea name="answer" cols="50" rows="5" maxlength="1000"></textarea>
                            <div class="button">
                                <button class="Form-Btn" onclick="location.href='#'">送信</button>
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>

        <hr>

        <iframe name="sendPhoto"></iframe>
        <?php
        foreach ($get_answers as $row) { //コメント表示
            $url_param = url_param_change(array("userId" => $row['userId']))
        ?>
            <section>
                <button onclick="location.href='transition_profile.php?<?php echo $url_param; ?>'" target='_blank' class='btn_ao_a'>
                    <span class="a__icon">
                        <img width="20px" src="./images/<?= $row['imagepath'] ?>" alt="<?= h($row['userName']) ?>">
                    </span>
                    <span>
                        <a id="nametag"><?= h($row['userName']) ?></a>
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
</body>

</html>