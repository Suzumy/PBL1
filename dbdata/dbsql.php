<?php

require_once __DIR__ . '/dbdata.php';

//ユーザー表示
class User extends DbData
{
    public function authUser($articleId)
    {

        $sql = "SELECT article.articleId,users.userId,users.userName,users.imagepath,article.title,article.explanation,article.articleimg1,article.articleimg2, article.urlpath FROM users,article WHERE users.userId=article.userId AND article.articleId = ?";
        //$sql = "SELECT article.articleId,users.userName,users.imagepath,article.title,article.explanation,article.articleimg1,article.articleimg2 FROM users,article WHERE users.userId=article.userId AND article.articleId = ?";
        $stmt = $this->query($sql, [$articleId]);
        return $stmt->fetch();
    }

    public function allarticle($num)
    {
        $sql = "SELECT article.articleId,title,users.userId,users.userName,users.imagepath,article.date FROM article,users WHERE users.userId=article.userId AND ORnum = ?;";

        $stmt = $this->query($sql, [$num]);
        return $stmt->fetchAll();
    }

    public function detailuser($userId)
    {
        $sql = "SELECT * FROM users WHERE userId = ?";
        $stmt = $this->query($sql, [$userId]);
        return $stmt->fetch();
    }

    //ログイン認証
    public function certification($address, $password)
    {
        $sql = "SELECT * FROM users WHERE address = ? and password = ?";
        $stmt = $this->query($sql, [$address, $password]);
        return $stmt->fetch();
    }

    //コメントをDBに保存する
    public function comment_storage($articleId, $userId, $comment)
    {
        $sql = "INSERT INTO comment(articleId, userId, comment) VALUES (
            (SELECT articleId FROM article WHERE articleId = ?),
            (SELECT userId FROM users WHERE userId = ?),
            ?)";
        $result = $this->exec($sql, [$articleId, $userId, $comment]);
    }

    //対象の記事に書いてあるコメントを一覧で取得する
    public function get_comment($articleId)
    {
        $sql = "SELECT * FROM comment LEFT OUTER JOIN users ON comment.userId = users.userId WHERE comment.articleId = ?";
        $stmt = $this->query($sql, [$articleId]);
        return $stmt->fetchAll();

    // require_once __DIR__.'/dbdata.php';

    // //ユーザー表示
    // class User extends DbData{
    //     public function authUser($articleId){

    //         $sql = "SELECT article.articleId,users.userId,users.userName,users.imagepath,article.title,article.explanation,article.articleimg1,article.articleimg2,article.urlpath FROM users,article WHERE users.userId=article.userId AND article.articleId = ?";
    //         //$sql = "SELECT article.articleId,users.userName,users.imagepath,article.title,article.explanation,article.articleimg1,article.articleimg2 FROM users,article WHERE users.userId=article.userId AND article.articleId = ?";
    //         $stmt = $this->query($sql,[$articleId]);
    //         return $stmt->fetch();
    //     }

    //     public function allarticle($num){
    //         $sql = "SELECT article.articleId,title,users.userId,users.userName,users.imagepath,article.date FROM article,users WHERE users.userId=article.userId AND ORnum = ?;";

    //         $stmt = $this->query($sql,[$num]);
    //         return $stmt->fetchAll();
    //     }

    //     public function detailuser($userId){
    //         $sql = "SELECT * FROM users WHERE userId = ?";
    //         $stmt = $this->query($sql,[$userId]);
    //         return $stmt->fetch();
    //     }

    //     //ログイン認証
    //     public function certification($userId, $password){
    //         $sql = "SELECT * FROM users WHERE address = ? and password = ?";
    //         $stmt = $this->query($sql, [$userId, $password]);
    //         return $stmt->fetch();
    //     }
      
    //   //コメントをDBに保存する
    //     public function comment_storage($articleId, $userId, $comment){
    //         $sql = "INSERT INTO comment(articleId, userId, comment) VALUES(?, ?, ?)";
    //         $result = $this->exec($sql, [$articleId, $userId, $comment]);
    //     }

    }
}
