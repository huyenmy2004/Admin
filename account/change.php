
<?php 
include "../connect-db.php";
include "pdo.php";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["changePasswordBtn"])) {
    $newPassword = $_POST['newPassword']; // Lấy mật khẩu mới từ form
    $username = $_SESSION['username']; // Lấy tên tài khoản hiện tại từ session

    // Gọi hàm updatePassword từ PDO để thực hiện cập nhật mật khẩu mới
    $accountManager = new Account();
    $accountManager->updatePassword($username, $newPassword);

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
    <title>change</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            font-weight: bold;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button-pop-up {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .button-pop-up button {
            background-color: #0071AF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }

        .button-pop-up button:last-child {
            background-color: #ccc;
        }

        .hidden-account-id {
            display: none;
        }
    </style>
</head>
<body>
<div id="changePasswordModal" class="modal">
    <div class="modal-content">
        <!-- ... (các phần khác của modal) ... -->
        <form method="POST" action="change.php">
            <div class="input-group">
                <label for="newPassword">Mật khẩu mới:</label>
                <input type="password" id="newPassword" name="newPassword" class="input-pass"required>
            </div>
            <div class="button-pop-up">
                <input type="hidden" class="hidden-account-id" name="accountId">
                <button type="submit" name="changePasswordBtn">Xác nhận</button>
                <button type="button" name="cancelChangePassword">Hủy bỏ</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
