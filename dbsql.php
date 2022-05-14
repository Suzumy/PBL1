<?php
    require_once __DIR__.'/dbdata.php';

    //ユーザー表示
    class User extends DbDate{
        public function authUser(){
            $sql = "SELECT users.userName,article.title,article.explanation,article.articleimg1,article.articleimg2 FROM users,article WHERE users.userId=article.userId";
            $stmt = $this->query($sql,[]);
            return $stmt->fetch();
        }

        //ログイン認証
        public function certification($userId, $password){
            $sql = "SELECT * FROM users WHERE userId = ? and password = ?";
            $stmt = $this->query($sql, [$userId, $password]);
            return $stmt->fetch();
        }
    }
?>