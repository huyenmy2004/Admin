<?php
require_once "../connect-db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['approve'])) {
    $conn = connectDB();

    $cusId = $_POST['cusId'];

    // Lấy thông tin mới từ các trường input
    $newCusName = $_POST['cusName'];
    $newCusContact = $_POST['cusContact'];
    $newCusPhone = $_POST['cusPhone'];
    $newcusAddress = $_POST['cusAddress'];
    $newcusGPP = $_POST['cusGPP'];
    $newcusGPPDate = $_POST['cusGPPDate'];
    $newcusGPPAddr = $_POST['cusGPPAddr'];
    // Lấy các thông tin khác tương tự

    // Cập nhật thông tin mới vào cơ sở dữ liệu
    $updateInfoQuery = "UPDATE customer SET cusName = '$newCusName', cusContact = '$newCusContact', cusPhone = '$newCusPhone', cusAddress ='$newcusAddress', cusGPP = '$newcusGPP', cusGPPDate ='$newcusGPPDate', cusGPPAddr='$newcusGPPAddr' WHERE cusId = '$cusId'";
    $resultUpdate = $conn->query($updateInfoQuery);

    if ($resultUpdate) {
        // Chuyển hướng trở lại trang Customer.php sau khi cập nhật thành công
        header("Location: Customer.php");
        exit();
    } else {
        // Xử lý trường hợp cập nhật thông tin thất bại
        echo "Cập nhật thông tin thất bại!";
    }
}
?>
