<?php
    require_once 'news-pdo.php';
    $news = new News(); 
    $data = [
        'newsTitle' => $_POST['newsTitle'],
        'newsData' => $_POST['newsData'],
        'newsImgTitle' => $_POST['newsImgTitle'],
        'newsContent' => $_POST['newsContent']
    ];
    $news->createNews($data);
    header("Location: http://localhost/PharmaDI-Admin/news/news-list.php");
?>