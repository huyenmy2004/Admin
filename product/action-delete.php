<?php
    require_once 'product-pdo.php';
    $product = new Product(); 
    $product->prodDelete($_GET['prodId']);
    header("Location: http://localhost/PharmaDI-Admin/product/product-list.php");
?>