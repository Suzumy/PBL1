<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>プロフィール</title>
		<link rel="stylesheet" type="text/css" href="css/profile.css">
	</head>
	<?php 
		require_once __DIR__ . '/header.php';
	?>
    <body class="wrap">
        <div class="content">
            <h1 class="heading-lv1 text-center">プロフィール</h1>
			<figure class="profile-image">
                <img src="./images/apple.png" width="300" height="300">
			</figure>
            <h2 class="heading-lv2 heading-margin text-center">食べかけの林檎</h2>

            <p class="text text-center">mac最高!!!</p>

			<button class="button2" onclick="location.href='profile_edit.php'">編集</button>
		
		</div>
    </body>
</html>