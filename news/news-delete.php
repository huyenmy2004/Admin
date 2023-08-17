<?php
    require_once 'news-pdo.php';
    $news = new News(); 
    $news->newsDelete($_GET['newsId']);
    header("Location: http://localhost/PharmaDI-Admin/news/news-list.php");
?>