<?php

include "pdo.php";

if (isset($_POST['addAccountBtn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO account (username, password, role, accStatus) VALUES (:username, :password, 0, 0)";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        
        echo "<script>alert('Tài khoản đã được thêm thành công!');</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Lỗi: " . $e->getMessage() . "');</script>";
    }
}
?>

</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <style>
.modal {
   
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
    border-radius:10px;
}

/* Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Input Styles */
.input-group {
    margin-bottom: 10px;
}

.input-group label {
    display: block;
    font-weight: bold;
}

.input-group input {
    width: 98%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* Button Style */
.button-pop-up {
    display: flex;
}
.button-pop-up button{
    background-color: #0091D0;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
</style>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("addAccountModal");
    var btn = document.querySelector(".btn-create");
    var span = document.getElementById("closeModal");
    var btnCancel = document.querySelector("[name='cancelAddAccount']");

    btn.onclick = function () {
        modal.style.display = "block";
    };

    span.onclick = function () {
        modal.style.display = "none";
    };

    btnCancel.onclick = function () {
        modal.style.display = "none";
    };

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
});
</script>
</head>
<body>
<div id="addAccountModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h2>Thêm mới tài khoản</h2>
        <form method="POST" action="">
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

</body>
</html>