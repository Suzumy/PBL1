<!DOCTYPE html>
<html>

<head>
    <title>投稿記事一覧</title>
</head>

<?php

    session_start();
    require_once __DIR__ . './header.php';
    require_once __DIR__.'/./dbdata/dbsql.php';
    $user = new User();

    $data = $_GET['data'];

    $users = $user->authUser($data[0]);
?>

<body bgcolor="#d9ead3" style="padding: 20px 100px;">
    <table>
        <tr>
            <td>
                <img src=" images/<?= $users['articleimg1'] ?>" alt="アイコン" width="20" height="20">
            </td>
            <td>
                <p><?= $users['userName'] ?></p>
            </td>
        </tr>
    </table>

    <ul style="list-style-type: circle;">
    </ul>
    <table style="border-collapse: collapse; width: 100%;" border="1">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: left; padding-left: 40px;"><?= $users['title'] ?></p>
                    <p style="text-align: left; padding-left: 40px;"><?= $users['explanation'] ?></p>
                    <img src=" images/<?= $users['articleimg1'] ?>" alt="アイコン" width="100" height="100">
                    <img src=" images/<?= $users['articleimg2'] ?>" alt="アイコン" width="100" height="100">
                </td>
            </tr>
        </tbody>
    </table>
    <button type="button">👍&nbsp;</button><button type="button">&nbsp;👎</button>
    
</body>

</html>