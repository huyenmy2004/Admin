<?php
include "../connect-db.php";
include "pdo.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["brandId"])) {
    $brandId = $_GET["brandId"];

    $brand = new Brand();
    $brand->deleteBrand($brandId);

    header("Location: brand-addmin.php");
    exit();
}

?>