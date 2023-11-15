<?php
require_once "order-pdo.php";
$order = new Order();
$order->updateOrder($_POST['orderStatus'], $_GET['orderId']);
header("Location: http://localhost/PharmaDI-Admin/order/order-list.php");
