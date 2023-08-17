<?php
include "../connect-db.php";
include "pdo.php";

$accountManager = new Account();
$accounts = $accountManager->getData();

// Handle search functionality
if (isset($_GET['search'])) {
    $searchKeyword = $_GET['search'];
    $accounts = $accountManager->searchAccountByContent($searchKeyword);
}

// Handle the change password functionality
if (isset($_POST['changePasswordBtn'])) {
    // Your existing change password logic
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>ACCOUNT</title>



</head>
<body>


<div class="navbar">
        <div class="navbar-box">
            <i class="fa-solid fa-bars active" style="color: #0071AF;"></i>
            <div class="navbar-user">
                <i class="fa-regular fa-circle-user"></i>
                <span>huyenmy</span>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
    </div>    
    <div class="sidebar">
        <h1>PHARMADI</h1>
        <div class="sidebar-box">
            <ul>
                <li>Trang chủ</li>
                <li>Sản phẩm</li>
                <li>Khách hàng</li>
                <li>Đơn hàng</li>
                <li>Thương hiệu</li>
                <li>Tài khoản</li>
            </ul>
        </div>
    </div>
    
        <!--content-area-->
        <div class="content">
        <form method = "GET" action="">
        <div class="status-box">
            <div class="status-content">
                <span>Trạng thái</span>
                <select>
                    <option value="1">Active</option>
                    <option value="2">Deactive</option>
                </select>
            </div>
            
            <div class="status-name-user">
                <span>Tên khách hàng</span>
                <input type="text" placeholder="Placeholder">
            </div>
            <button type = "submit" style="padding-left: 0px;padding-right: 0px;

    border-radius: 8px;
    background: var(--d-9-d-9-d-9, #0071AF);
    border: none;
    color: white;
    width: 90px;
    height: 40px;
">Tìm kiếm</button>
        </div>
        </form>

    
        <div class="account-box">
            <div class="label-and-button">
            <div class="label">
            <h1>DANH SÁCH TÀI KHOẢN</h1>
            </div>
            <div class="create">
    <a href="create.php" class="btn-create">Thêm mới</a>
</div>
            </div>
            <table>
                <tr class="account-box-select">
                <th style="width:150px">STT</th>
                <th style="width:200px">Mã khách hàng</th>
                <th style="width:200px" >Tên tài khoản</th>
                <th style="width:150px">Phân quyền</th>
                <th>Hành động</th>


                </tr>
                <?php 
            $i=1;
                foreach ($accounts as $account): ?>
            <tbody>
            <tr class="table-body">
                <td ><?= $i++ ?></td>
                <td ><?= $account['cusId'] ?></td>
                <td ><?= $account['username'] ?></td>
                <td>
    <?php if ($account['role'] == 0): ?>
        Khách
    <?php elseif ($account['role'] == 1): ?>
        Admin
    <?php else: ?>
        <!-- Nếu role không phải 0 hoặc 1 -->
        Không xác định
    <?php endif; ?>
</td>
                <td style="display: flex;
    justify-content: space-around;
    align-items: center;">
                    <div class="change-function">
    <a href="change.php?cusId=<?= $account['cusId'] ?>" class="btn-a btn-change">Đổi mật khẩu</a>
</div>
<div class="block-function">
                    <button type="submit" name="block-account-btn" class="btn-a btn-block">Chặn tài khoản</button>

                    </div>
                    <div class="delete-function">
                    <div class="delete-function">
    <form method="POST" action="delete.php">
        <input type="hidden" name="cusId" value="<?= $account['cusId'] ?>">
        <button type="submit" name="delete-account-btn" class="btn-a btn-delete">Xóa tài khoản</button>
    </form>
</div>
                    </div>
                </td>

            </tr>
            </tbody>
        <?php endforeach; ?>
        </table>
        </div>
        
</body>
</html>