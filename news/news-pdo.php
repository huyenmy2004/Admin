<?php
require_once "../connect-db.php";
class News extends Connection
{
    public function createNews($data){
        $sql = "INSERT INTO news(newsTitle, newsImage, newsImgTitle, newsContent) VALUES (:newsTitle, :newsData, :newsImgTitle, :newsContent)";
        $create = $this->prepareSQL($sql);
        $create->execute($data);
    }
    public function getData($title){
        $sql = "SELECT * FROM news " . ($title != null ? "WHERE newsTitle LIKE '%{$title}%'" : ' ') . " ORDER BY newsLastUpdate DESC, newsCreatedDate DESC";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll();
    }
    public function newsDetail($id){
        $sql = "SELECT * FROM news WHERE newsId = '$id'";
        $select = $this->prepareSQL($sql);
        $select->execute();
        return $select->fetchAll()[0];
    }
    public function newsUpdate($data){
        $sql = "UPDATE news SET newsTitle=:newsTitle, newsImage=:newsImage, newsImgTitle=:newsImgTitle, newsContent=:newsContent WHERE newsId = :newsId;";
        $select = $this->prepareSQL($sql);
        $select->execute($data);
    }
    public function newsDelete($id){
        $sql = "DELETE FROM news WHERE newsId = '$id';";
        $select = $this->prepareSQL($sql);
        $select->execute();
    }
}