<?php
require_once "../connect-db.php";

$conn = connectDB();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Customer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Admin Order</title>
</head>
<body>
<div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="title">PHARMADI</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="title">Trang chủ</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="title">Sản phẩmm</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="title">Khách hàng</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="title">Đơn hàng</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="title">Thương hiệu</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="title">Tài khoản</span>
                    </a>
                </li>
            </ul>
        </div>
        <!--main-->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline" class="menu-icon"></ion-icon>
                </div>
        <!--user-->
                <div class="user">
                    <ion-icon name="person-circle-outline" class="user-icon"></ion-icon>
                    <div class="user-name">
                        <p>Huyen My</p>
                    </div>
                    <ion-icon name="chevron-down-outline" class="drop-down-icon"></ion-icon>
                </div>
            </div>
        </div>
        </div>
        
    <div class="content">
            <div class="search-form">
                <form action="" method="get">
                    <div class="status">
                            <span>Trạng thái</span>
                            <select name="cusStatus" class="search-box">
                                <option value="Tat Ca">Tất cả</option>
                                <option value="Duyet">Duyệt</option>
                                <option value="Chưa duyệt">Chưa duyệt</option>
                            </select>
                        
                    </div>

                    <div class="name-user">      
                            <span>Tên khách hàng</span>
                            <input type="text" name="cusName" class="search-box" placeholder="  Nhập tên khách hàng">                       
                    </div>

                    <button type="submit" class="search-btn">Tìm kiếm</button>
                </form>
            </div>

    <p>DANH SÁCH KHÁCH HÀNG</p>

    <?php

    if (isset($_GET['cusStatus']) || isset($_GET['cusName'])) {
     
        $status = $_GET['cusStatus'];
        $cusName = $_GET['cusName'];

        $sql = "SELECT * FROM customer WHERE 1=1"; 
        if (!empty($status)) {
            if ($status === "Tat Ca") {
              
            } else {
                $sql .= " AND cusStatus='$status'";
            }
        }

        if (!empty($cusName)) {
            $sql .= " AND cusName LIKE '%$cusName%'";
        }

        $result = $conn->query($sql);

  
        echo '<div class="customer-table">';
        echo '<table>';
        echo '<tr>
            <th>STT</th>
            <th>Mã khách hàng</th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Số GPP</th>
            <th>Trạng thái</th>
        </tr>';

        if ($result->num_rows > 0) {
            $index = 1;
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
            echo '<td>' . $index . '</td>';
            echo '<td><a href="';
            if ($row["cusStatus"] === "Chưa duyệt") {
                echo 'CustomerAddNew.php?cusId=' . $row["cusId"];
            } else {
                echo 'CustomerEdit.php?cusId=' . $row["cusId"];
            }
            echo '">' . $row["cusId"] . '</a></td>';
            echo '<td><a href="';
            if ($row["cusStatus"] === "Chưa duyệt") {
                echo 'CustomerAddNew.php?cusId=' . $row["cusId"];
            } else {
                echo 'CustomerEdit.php?cusId=' . $row["cusId"];
            }
            echo '">' . $row["cusName"] . '</a></td>';
            echo '<td><a href="';
            if ($row["cusStatus"] === "Chưa duyệt") {
                echo 'CustomerAddNew.php?cusId=' . $row["cusId"];
            } else {
                echo 'CustomerEdit.php?cusId=' . $row["cusId"];
            }
            echo '">' . $row["cusPhone"] . '</a></td>';
            echo '<td><a href="';
            if ($row["cusStatus"] === "Chưa duyệt") {
                echo 'CustomerAddNew.php?cusId=' . $row["cusId"];
            } else {
                echo 'CustomerEdit.php?cusId=' . $row["cusId"];
            }
            echo '">' . $row["cusAddress"] . '</a></td>';
            echo '<td><a href="';
            if ($row["cusStatus"] === "Chưa duyệt") {
                echo 'CustomerAddNew.php?cusId=' . $row["cusId"];
            } else {
                echo 'CustomerEdit.php?cusId=' . $row["cusId"];
            }
            echo '">' . $row["cusGPP"] . '</a></td>';
            echo '<td><a href="';
            if ($row["cusStatus"] === "Chưa duyệt") {
                echo 'CustomerAddNew.php?cusId=' . $row["cusId"];
            } else {
                echo 'CustomerEdit.php?cusId=' . $row["cusId"];
            }
            echo '">' . $row["cusStatus"] . '</a></td>';
            echo '</tr>';
                $index++;
            }
        } else {
            echo '<tr><td colspan="7">Không tìm thấy kết quả phù hợp.</td></tr>';
        }

        echo '</table>';
        echo '</div>';
    } else {
        $sql = "SELECT * FROM customer";
        $result = $conn->query($sql);

        echo '<div class="customer-table">';
        echo '<table>';
        echo '<tr>
            <th>STT</th>
            <th>Mã khách hàng</th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Số GPP</th>
            <th>Trạng thái</th>
        </tr>';

        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<div id="success-message" class="success-message">
                 Thông tin khách hàng đã được cập nhật thành công!
                </div>';
        }

        if ($result->num_rows > 0) {
            $index = 1;
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
            echo '<td>' . $index . '</td>';
            echo '<td><a href="';
            if ($row["cusStatus"] === "Chưa duyệt") {
                echo 'CustomerAddNew.php?cusId=' . $row["cusId"];
            } else {
                echo 'CustomerEdit.php?cusId=' . $row["cusId"];
            }
            echo '">' . $row["cusId"] . '</a></td>';
            echo '<td><a href="';
            if ($row["cusStatus"] === "Chưa duyệt") {
                echo 'CustomerAddNew.php?cusId=' . $row["cusId"];
            } else {
                echo 'CustomerEdit.php?cusId=' . $row["cusId"];
            }
            echo '">' . $row["cusName"] . '</a></td>';
            echo '<td><a href="';
            if ($row["cusStatus"] === "Chưa duyệt") {
                echo 'CustomerAddNew.php?cusId=' . $row["cusId"];
            } else {
                echo 'CustomerEdit.php?cusId=' . $row["cusId"];
            }
            echo '">' . $row["cusPhone"] . '</a></td>';
            echo '<td><a href="';
            if ($row["cusStatus"] === "Chưa duyệt") {
                echo 'CustomerAddNew.php?cusId=' . $row["cusId"];
            } else {
                echo 'CustomerEdit.php?cusId=' . $row["cusId"];
            }
            echo '">' . $row["cusAddress"] . '</a></td>';
            echo '<td><a href="';
            if ($row["cusStatus"] === "Chưa duyệt") {
                echo 'CustomerAddNew.php?cusId=' . $row["cusId"];
            } else {
                echo 'CustomerEdit.php?cusId=' . $row["cusId"];
            }
            echo '">' . $row["cusGPP"] . '</a></td>';
            echo '<td><a href="';
            if ($row["cusStatus"] === "Chưa duyệt") {
                echo 'CustomerAddNew.php?cusId=' . $row["cusId"];
            } else {
                echo 'CustomerEdit.php?cusId=' . $row["cusId"];
            }
            echo '">' . $row["cusStatus"] . '</a></td>';
            echo '</tr>';
                $index++;
            }
        } else {
            echo '<tr><td colspan="7">Không có dữ liệu khách hàng.</td></tr>';
        }

        echo '</table>';
        echo '</div>';
    }

    $conn->close();
    ?>
    </div>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script>

    let list=document.querySelectorAll('.navigation li');
    function activeLink(){
        list.forEach((item)=>
        item.classList.remove('hovered'));
        this.classList.add('hovered');
    }
    list.forEach((item)=>
    item.addEventListener('mouseover', activeLink));

   
</script>

</html>
