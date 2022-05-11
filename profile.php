<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>プロフィール</title>
		<link rel="stylesheet" type="text/css" href="css/profile.css">
	</head>
	<?php
		require_once __DIR__ . './header.php';
		require_once __DIR__.'/./dbdata/dbsql.php';
        $user = new User();

		$data = $_GET['userId'];

		$profile = $user->detailuser($data[0]);

	?>
    <body class="wrap">
        <div class="content">
            <h1 class="heading-lv1 text-center">プロフィール</h1>
			<figure class="profile-image">
                <img src="./images/<?= $profile['imagepath'] ?>" width="300" height="300">
			</figure>
            <h2 class="heading-lv2 heading-margin text-center"><?= $profile['userName'] ?></h2>

            <p class="text text-center"><?= $profile['profile'] ?></p>


			<button class="button2" onclick="location.href='profile_edit.php'">編集</button>
		
		</div>
    </body>
</html>