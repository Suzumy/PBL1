<?php
    require_once __DIR__.'/dbdata.php';

    //ユーザー表示
    class User extends DbData{
        public function authUser($articleId){
            $sql = "SELECT article.articleId,users.userName,users.imagepath,article.title,article.explanation,article.articleimg1,article.articleimg2 FROM users,article WHERE users.userId=article.userId AND article.articleId = ?";
            $stmt = $this->query($sql,[$articleId]);
            return $stmt->fetch();
        }

        public function allarticle(){
            $sql = "SELECT article.articleId,title,users.userName,users.imagepath FROM article,users WHERE users.userId=article.userId;";
            $stmt = $this->query($sql,[]);
            return $stmt->fetchAll();
        }

        //ログイン認証
        public function certification($userId, $password){
            $sql = "SELECT * FROM users WHERE address = ? and password = ?";
            $stmt = $this->query($sql, [$userId, $password]);
            return $stmt->fetch();
        }

        //コメントをDBに保存する
        public function comment_storage($articleId, $userId, $comment){
            $sql = "INSERT INTO comment(articleId, userId, comment) VALUES (
                (SELECT articleId FROM article WHERE articleId = ?),
                (SELECT userId FROM users WHERE userId = ?),
                ?)";
            $result = $this->exec($sql, [$articleId, $userId, $comment]);
        }

        //対象の記事に書いてあるコメントを一覧で取得する
        public function get_comment($articleId){
            $sql = "SELECT * FROM comment WHERE articleId = ?";
            $stmt = $this->query($sql, [$articleId]);
            return $stmt->fetchAll();
        }
    }
?>