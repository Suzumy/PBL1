<?php
 require_once __DIR__.'/dbdata/dbsql.php';
 $user = new User();
 
 session_start();
 $articleId = $_SESSION['articleId'];
 $users = $user->authUser($articleId);

 foreach($users as $row){
     echo $row.'<br>';
 }