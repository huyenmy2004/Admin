<?php
// update_customer.php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cusId"])) {
    require_once "../connect-db.php";
    $conn = connectDB();

    $cusId = $_POST["cusId"];
    // Cập nhật trạng thái thành "Duyệt"
    $updateQuery = "UPDATE customer SET cusStatus = 'Duyệt' WHERE cusId = '$cusId'";

    if ($conn->query($updateQuery) === TRUE) {
        // Chuyển hướng về trang Customer.php với thông báo thành công
        header("Location: Customer.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật trạng thái: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>
