<?php
require_once("account-pdo.php");
$account = new Account();
$account->check($_GET['cusId']) != null ? header("Location: http://localhost/PharmaDI-Admin/account/account-list.php") :
$account->delete($_GET['username'], $_GET['cusId']);
header("Location: http://localhost/PharmaDI-Admin/account/account-list.php");
