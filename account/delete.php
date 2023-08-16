<?php
include "../connect-db.php";
include "pdo.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-account-btn"])) {
    $cusId = $_POST['cusId'];

    $account = new Account();
    $account->deleteAccount($cusId);

    header("Location: account-list.php");
    exit();
}
?>