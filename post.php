<?php

require_once __DIR__ . './dbdata/dbdata.php';
class Post extends DbData
{
    //制作物記事を投稿する
    public function post_article($userId, $title, $explanation, $arti0, $arti1, $arti2, $arti3, $urlpath)
    {
        $sql = "INSERT INTO article (userId, title, explanation, articleimg1, articleimg2, articleimg3, articleimg4, urlpath) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $result = $this->exec($sql, [$userId, $title, $explanation, $arti0, $arti1, $arti2, $arti3, $urlpath]);
    }
}
