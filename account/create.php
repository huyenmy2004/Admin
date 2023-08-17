<?php 

include "pdo.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addAccountBtn"])) {
    $username = $_POST['phoneNumber'];
    $password = $_POST['password'];

    // Gọi hàm addAccount từ PDO để thêm mới tài khoản
    $accountManager = new Account();
    $accountManager->addAccount($username, $password);

    // Chuyển hướng hoặc hiển thị thông báo thành công
    header("Location: account-list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/account.css">
    <!-- Include other necessary CSS files -->
    <title>Thêm mới tài khoản</title>
</head>
<body>
    <div id="addAccountModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Thêm mới tài khoản</h2>
            <form method="POST" action="create.php">
                <div class="input-group">
                    <label for="phoneNumber">Tên tài khoản:</label>
                    <input type="text" id="phoneNumber" name="phoneNumber" required>
                </div>
                <div class="input-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="button-pop-up">
                    <button type="submit" name="addAccountBtn">Thêm mới</button>
                    <button type="button" name="cancelAddAccount" class="btn-cancel">Hủy bỏ</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Include other necessary HTML content -->
</body>
</html>