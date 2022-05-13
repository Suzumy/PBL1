<?php
    require_once __DIR__.'/dbdata.php';

    //ユーザー表示
    class User extends DbData{
        public function authUser($articleId){

            $sql = "SELECT article.articleId,users.userId,users.userName,users.imagepath,article.title,article.explanation,article.articleimg1,article.articleimg2, article.ORnum FROM users,article WHERE users.userId=article.userId AND article.articleId = ?";
            //$sql = "SELECT article.articleId,users.userName,users.imagepath,article.title,article.explanation,article.articleimg1,article.articleimg2 FROM users,article WHERE users.userId=article.userId AND article.articleId = ?";
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

        //ログイン認証
        public function certification($address, $password){
            $sql = "SELECT * FROM users WHERE address = ? and password = ?";
            $stmt = $this->query($sql, [$address, $password]);
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
            $sql = "SELECT * FROM comment LEFT OUTER JOIN users ON comment.userId = users.userId 
                    WHERE comment.articleId = ?";
            $stmt = $this->query($sql, [$articleId]);
            return $stmt->fetchAll();
        }

        //質問の回答をanswersテーブルに保存する
        public function ans_storage($articleId, $userId, $ans){
            $sql = "INSERT INTO answers(articleId, userId, answer) VALUES (
                (SELECT articleId FROM article WHERE articleId = ?),
                (SELECT userId FROM users WHERE userId = ?),
                ?)";
            $result = $this->exec($sql, [$articleId, $userId, $ans]);
        }

        //対象の質問に書いてある回答を一覧で取得する
        public function get_answers($articleId){
            $sql ="SELECT * FROM answers LEFT OUTER JOIN users ON answers.userId = users.userId 
                   WHERE answers.articleId = ?";
            $stmt = $this->query($sql, [$articleId]);
            return $stmt->fetchAll();
        }
    }