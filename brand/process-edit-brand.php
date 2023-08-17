<?php
include "pdo.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brandId = $_POST["brand_id"];
    $newBrandName = $_POST["input-brand"];
    $newBrandLogo = $_POST["input-logo"];
    $newBrandDescription = $_POST["input-brand-descript"];

    $brand = new Brand();
    $brand->updateBrand($brandId, [
        'brandName' => $newBrandName,
        'brandLogo' => $newBrandLogo,
        'brandDescription' => $newBrandDescription
    ]);

    header("Location: brand-addmin.php?brandId=$brandId");
    exit();
}
?>