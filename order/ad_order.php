<?php
    require_once 'connection/pdo.php';
    $getinf = new Query();
    $products = $getinf->all_ad();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ad_order.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Admin Order</title>
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
    

    <div class="content">
        <form method = "GET" action="">
        <div class="status-box">
            <div class="status-content">
                <span>Trạng thái</span>
                <select>
                    <option value="1">Chờ xác nhận</option>
                    <option value="2">Đã xác nhận</option>
                    <option value="3">Đang giao hàng</option>
                    <option value="4">Đã giao hàng</option>
                    <option value="5">Huỷ đơn hàng</option>
                </select>
            </div>
            <div class="status-date">
                <span>Ngày đặt</span>
                <input type="text" placeholder="Placeholder">
            </div>
            <div class="status-name-user">
                <span>Tên khách hàng</span>
                <input type="text" placeholder="Placeholder">
            </div>
            <button type = "submit">Tìm kiếm</button>
        </div>
        </form>

        <?php
        if(isset($_GET["submit"])){
            $keys = $_GET['submit'];
            $getkeys = new Query();
            $searchs = $getkeys->search($keys); 
        ?>

        <div class="order-box">
            <h1>DANH SÁCH ĐƠN HÀNG</h1>
            <table>
                <tr class="order-box-select">
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                </tr>
                <?php 
                $i = 1;
                foreach ($searchs as $search) : ?>
                <tr>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $i++?></a></td>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $search['orderId'] ?></a></td>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $search['orderDate'] ?></a></td>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $search['cusName'] ?></a></td>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $search['cusPhone'] ?></a></td>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $search['cusGPPAddr'] ?></a></td>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $search['prodNumber'] * $search['prodOldPrice']?></a></td>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?php if($search['orderStatus'] == 1) echo "Chờ xác nhận";
                        else if($search['orderStatus'] == 2) echo "Đã xác nhận";
                        else if($search['orderStatus'] == 3) echo "Đang giao hàng";
                        else if($search['orderStatus'] == 4) echo "Đã giao hàng";
                        else if($search['orderStatus'] == 5) echo "Huỷ đơn hàng";
                    ?></a></td>
                </tr>
                <?php  endforeach; ?>
            </table>
        </div>
        <?php } else { ?>

        <div class="order-box">
            <h1>DANH SÁCH ĐƠN HÀNG</h1>
            <table>
                <tr class="order-box-select">
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                </tr>
                <?php 
                $i = 1;
                foreach ($products as $product) : ?>
                <tr>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $i++?></a></td>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $product['orderId'] ?></a></td>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $product['orderDate'] ?></a></td>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $product['cusName'] ?></a></td>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $product['cusPhone'] ?></a></td>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $product['cusGPPAddr'] ?></a></td>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $product['prodNumber'] * $product['prodOldPrice']?></a></td>
                    <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?php if($product['orderStatus'] == 1) echo "Chờ xác nhận";
                        else if($product['orderStatus'] == 2) echo "Đã xác nhận";
                        else if($product['orderStatus'] == 3) echo "Đang giao hàng";
                        else if($product['orderStatus'] == 4) echo "Đã giao hàng";
                        else if($product['orderStatus'] == 5) echo "Huỷ đơn hàng";
                    ?></a></td>
                </tr>
                <?php  endforeach; ?>
            </table>
        </div>
        <?php } ?>


        <div class="swich-tab">
            <span>10</span>
            <p>Tổng số 2211 kết quả</p>
            <i class="fa-solid fa-angles-left"></i>
            <i class="fa-solid fa-angle-left"></i>
            <button>number</button>
            <i class="fa-solid fa-angle-right"></i>
            <i class="fa-solid fa-angles-right"></i>
        </div>
    </div>
    <script src="ad_order.js"></script>
</body>
</html>