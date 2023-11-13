<?php
    require_once 'customer-pdo.php';
    $customer = new Customer();
    $data = [
        'cusId' => $_POST['cusId'],
        'cusName' => $_POST['cusName'],
        'cusContact' => $_POST['cusContact'], 
        'cusPhone' => $_POST['cusPhone'],
        'cusAddress'=> $_POST['cusAddress'],
        'cusGPP'=> $_POST['cusGPP'],
        'cusGPPDate' => $_POST['cusGPPDate'],
        'cusGPPAddr' => $_POST['cusGPPAddr'],
    ];
    $customer->cusUpdate($data);
    header("Location: http://localhost/PharmaDI-Admin/customer/customer-list.php");
?>