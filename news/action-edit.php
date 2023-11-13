<?php
require_once("news-pdo.php");
$news = new News();
$data = [
    "newsId" => $_GET["newsId"],
    "newsTitle" => $_POST["newsTitle"],
    "newsImage" => $_POST["newsData"],
    "newsImgTitle" => $_POST["newsImgTitle"],
    "newsContent" => $_POST["newsContent"],
];
$news->newsUpdate($data);
header("Location: http://localhost/PharmaDI-Admin/news/news-list.php");
