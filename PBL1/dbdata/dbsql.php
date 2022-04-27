<?php
    require_once __DIR__.'/dbdata.php';

    //ユーザー表示
    class User extends DbData{
        public function authUser($articleId){
            $sql = "SELECT article.articleId,users.userId,users.userName,users.imagepath,article.title,article.explanation,article.articleimg1,article.articleimg2 FROM users,article WHERE users.userId=article.userId AND article.articleId = ?";
            $stmt = $this->query($sql,[$articleId]);
            return $stmt->fetch();
        }

        public function allarticle(){
            $sql = "SELECT article.articleId,title,users.userId,users.userName,users.imagepath,article.date FROM article,users WHERE users.userId=article.userId;";
            $stmt = $this->query($sql,[]);
            return $stmt->fetchAll();
        }

        public function detailuser($userId){
            $sql = "SELECT * FROM users WHERE userId = ?";
            $stmt = $this->query($sql,[$userId]);
            return $stmt->fetch();
        }
    }
?>