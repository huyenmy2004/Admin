<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CustomerAddNew.css">
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
        <div class="breadcrumb0">
            <ul class="breadcrumb">
                <li><a href="Customer.php" class="a1">Danh sách khách hàng</a></li>
                <li><a href="#" class="a2">Chi tiết khách hàng</a></li>
            </ul>
        </div>

        <div class="accept_info">
            

                <form action="updateStatus_customer.php" method="POST">

                    <div class="content1">
                        <p>THÔNG TIN KHÁCH HÀNG</p>
                        <input type="hidden" name="cusId" value="<?= $cusId ?>">
                        <button type="submit" class="btn-accept">Phê duyệt</button>
                        
                    </div>

                    <?php
                        require_once "../connect-db.php";

                        $conn = connectDB();

                        if (isset($_GET['cusId'])) {
                            $cusId = $_GET['cusId'];
                            $sql = "SELECT * FROM customer WHERE cusId = '$cusId'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $cusName = $row["cusName"];
                                $cusContact = $row["cusContact"];
                                $cusPhone = $row["cusPhone"];
                                $cusAddress = $row["cusAddress"];
                                $cusGPP = $row["cusGPP"];
                                $cusGPPDate = $row["cusGPPDate"];
                                $cusGPPAddr = $row["cusGPPAddr"];
                                $cusStatus = $row["cusStatus"];
                            } else {
                                // Xử lý khi không tìm thấy khách hàng.
                            }
                        }
                    ?>

                    <div class="content1">
                        <div class="id">
                            <span>Mã khách hàng</span>
                            <input type="text" name="cusId" class="cusId" value="<?= $cusId ?>" placeholder="" readonly>
                        </div>
                        <div class="Status">
                            <span>Trạng thái</span>
                            <input type="text" name="cusStatus" class="cusStatus" value="<?= $cusStatus ?>" placeholder="" readonly>
                        </div>
                    </div>

                    <div class="Name">
                        <span>Tên nhà thuốc</span>
                        <input type="text" name="cusName" class="cusName" value="<?= $cusName ?>" placeholder="" readonly>
                    </div>

                    <div class="content1">
                        <div class="Contact">
                            <span>Tên người liên hệ</span>
                            <input type="text" name="cusContact" class="cusContact" value="<?= $cusContact ?>" placeholder="" readonly>
                        </div>
                        <div class="Phone">
                            <span>Số điện thoại</span>
                            <input type="text" name="cusPhone" class="cusPhone" value="<?= $cusPhone ?>" placeholder="" readonly>
                        </div>
                    </div>

                    <div class="Address">
                        <span>Địa chỉ</span>
                        <input type="text" name="cusAddress" class="cusAddress" value="<?= $cusAddress ?>" placeholder="" readonly>
                    </div>

                    <div class="content1">
                        <div class="GPP">
                            <span>Số GPP</span>
                            <input type="text" name="cusGPP" class="cusGPP" value="<?= $cusGPP ?>" placeholder="" readonly>
                        </div>
                        <div class="GPPDate">
                            <span>Ngày cấp</span>
                            <input type="text" name="cusGPPDate" class="cusGPPDate" value="<?= $cusGPPDate ?>" placeholder="" readonly>
                        </div>
                    </div>

                    <div class="GPPAddr">
                        <span>Nơi cấp</span>
                        <input type="text" name="cusGPPAddr" class="cusGPPAddr" value="<?= $cusGPPAddr ?>" placeholder="" readonly>
                    </div>
                </form>
        </div>

</div>

        </body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>