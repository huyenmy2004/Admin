<?php
require_once "pdo.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ POST request
    $brandName = isset($_POST["input-brand"]) ? trim($_POST["input-brand"]) : '';
    $brandLogo = isset($_POST["input-logo"]) ? trim($_POST["input-logo"]) : '';
    $brandDescription = isset($_POST["input-brand-descript"]) ? trim($_POST["input-brand-descript"]) : '';

    $brandData = [
        'brandName' => $brandName,
        'brandLogo' => $brandLogo,
        'brandDescription' => $brandDescription
    ];

    $brandInstance = new Brand();
    $response = $brandInstance->createNewBrand($brandData);

    
    exit();
}


?>