<?php
    require_once 'order-pdo.php';
    $order = new Order(); 
    $order->orderDelete($_GET['orderId']);
    header("Location: http://localhost/PharmaDI-Admin/order/order-list.php");
?>