<?php
    if(!isset($_SESSION)){
        session_start();
    }

    $userId = isset($_SESSION['userId'])?$_SESSION['userId']:'';
    $userName = isset($_SESSION['userName'])?$_SESSION['userName']:'';

    if(empty($userId)||empty($userName)){
        if(isset($_COOKIE['userId'])&&isset($_COOKIE['userName'])){
            $userId = $_COOKIE['userId'];
            $userName = $_COOKIE['userName'];
        }else{
            $userId = (string)mt_rand(10000000,99999999);
            $userName = '名無し';
            setcookie("userId",$userId,time() + 60*60*24*14,'/');
            setcookie("userName",$userName,time() + 60*60*24*14,'/');
        }

        $_SESSION['userId'] = $userId;
        $_SESSION['userName'] = $userName;
    }

    $http_host = '//'.$_SERVER['SERVER_NAME'];
    
    $home_php = $http_host.'/home.php';
    $detail_php = $http_host.'/detail.php';