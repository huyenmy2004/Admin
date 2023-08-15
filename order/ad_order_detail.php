<?php
    require_once 'connection/pdo.php';
    $id = $_GET['id'];
    $getinf = new Query();
    $products = $getinf->select($id);
    $getBrand = new Query();
    $brands = $getBrand->select_brand($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ad_order.css">
    <link rel="stylesheet" href="ad_order_detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Admin Order Detail</title>
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
        <div class="content-menu">
            <span><a href="ad_order.php">Danh sách đơn hàng</a></span>
            <i class="fa-solid fa-angle-right" style="color: #0071AF;"></i>
            <p>Chi tiết đơn hàng</p>
        </div>
        <div class="order-detail-box-option">
            <h1>THÔNG TIN ĐƠN HÀNG</h1>
            <?php 
                $i = 1;
                foreach ($products as $product) : 
                    if($i == 1) { $i++;
            ?><?php } endforeach; ?>
            <?php if($product['orderStatus'] == 1) {?>
            <div class="order-detail-box-option-button">

            <button class="button-delete" onclick="confirmDelete()">Xoá đơn hàng</button>
                <div class="confirm-delete-popup">
                    <span>XOÁ ĐƠN HÀNG ĐÃ CHỌN?</span>
                    <p>Bạn có chắc chắn muốn xoá đơn hàng đã chọn không?</p>
                    <div class="confirm-popup-button">
                        <button class="confirm-popup-cancel" onclick="closeDeletePopup()">Huỷ bỏ</button>
                        <form method="POST" action="confirmDelete.php">
                        <input type="hidden" value="<?= $product['orderId'] ?>" name="id">
                        <button type = "submit" class="confirm-popup-delete">Xác nhận</button>
                        </form>
                    </div>
                </div>

            <button class="button-cancle" onclick="confirmCancle()">Từ chối</button>
                <div class="confirm-popup">
                    <span>TỪ CHỐI XÁC NHẬN?</span>
                    <p>Bạn có chắc chắn muốn từ chối xác nhận đơn hàng đã chọn không?</p>
                    <div class="confirm-popup-button">
                        <button class="confirm-popup-cancel" onclick="closePopup()">Huỷ bỏ</button>
                        <form method="POST" action="confirmCancle.php">
                            <input type="hidden" value="<?= $product['orderId'] ?>" name="id">
                            <button type = "submit" class="confirm-popup-delete">Xác nhận</button>
                        </form>
                    </div>
                </div>

                <button class="button-confirm" onclick="confirmButton()">Xác nhận</button>
                <div class="confirm-order-popup">
                    <span>XÁC NHẬN ĐƠN HÀNG</span>
                    <p>Bạn có chắc chắn muốn xác nhận đơn hàng đã chọn không?</p>
                    <div class="confirm-popup-button">
                        <button class="confirm-popup-cancel" onclick="closeConfirmPopup()">Huỷ bỏ</button>
                        <form method="POST" action="confirmOrder.php">
                            <input type="hidden" value="<?= $product['orderId'] ?>" name="id">
                            <button type = "submit" class="confirm-popup-delete">Xác nhận</button>
                        </form>
                    </div>
                </div> 

            </div>
            <?php } else { ?>
                <div class="order-detail-box-option-button">

                <button class="button-delete" onclick="confirmDelete()">Xoá đơn hàng</button>
                <div class="confirm-delete-popup" style="left: -600%;">
                    <span>XOÁ ĐƠN HÀNG ĐÃ CHỌN?</span>
                    <p>Bạn có chắc chắn muốn xoá đơn hàng đã chọn không?</p>
                    <div class="confirm-popup-button">
                        <button class="confirm-popup-cancel" onclick="closeDeletePopup()">Huỷ bỏ</button>
                        <form method="POST" action="confirmDelete.php">
                        <input type="hidden" value="<?= $product['orderId'] ?>" name="id">
                        <button type = "submit" class="confirm-popup-delete">Xác nhận</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
        <?php 
            $i = 1;
            foreach ($products as $product) : 
                if($i == 1) { $i++;
        ?>
        <div class="order-detail-box">
            <div class="order-detail-box-status">
                <span>Mã đơn hàng</span>
                <p><?= $product['orderId'] ?></p>
            </div>
            <div class="order-detail-box-status">
                <span>Trạng thái</span>
                <p><?php if($product['orderStatus'] == 1) echo "Chờ xác nhận";
                        else if($product['orderStatus'] == 2) echo "Đã xác nhận";
                        else if($product['orderStatus'] == 3) echo "Đang giao hàng";
                        else if($product['orderStatus'] == 4) echo "Đã giao hàng";
                        else if($product['orderStatus'] == 5) echo "Huỷ đơn hàng";
                    ?></p>
            </div>
            <div class="order-detail-box-status">
                <span>Tên nhà thuốc</span>
                <p><?= $product['brandName'] ?></p>
            </div>
            <div class="order-detail-box-status">
                <span>Tên liên hệ</span>
                <p><?= $product['cusName'] ?></p>
            </div>
            <div class="order-detail-box-status">
                <span>Số điện thoại</span>
                <p><?= $product['cusPhone'] ?></p>
            </div>
            <div class="order-detail-box-status">
                <span>Ngày đặt hàng</span>
                <p><?= $product['orderDate'] ?></p>
            </div>
        </div>
        <div class="order-detail-long-box">
            <div class="order-detail-long-box-status">
                <span>Địa chỉ</span>
                <p><?= $product['cusGPPAddr'] ?></p>
            </div>
            <div class="order-detail-long-box-status">
                <span>Ghi chú</span>
                <p><?php if($product['orderNote'] != "") echo $product['orderNote'];
                else echo "Trống";?></p>
            </div>
        </div>
        <?php } endforeach; ?>

        <div class="order-detail-list">
            <h1>Danh sách sản phẩm</h1>

            <?php 
                foreach ($brands as $brand) :   
            ?>
            <div class="order-list-brand">
                <div class="order-list-brand-img"><img src="<?= $brand['brandLogo'] ?>" alt=""></div>
                <div>
                    <ul class="order-list-brand-title">
                        <li class="order-list-brand-title-name">Tên sản phẩm</li>
                        <li class="order-list-brand-title-num">Số lượng</li>
                        <li class="order-list-brand-title-price">Giá tiền</li>
                    </ul>
                </div>
                <?php 
                foreach ($products as $product) : 
                        
                        if($brand['brandId'] == $product['brandId']) {
                ?>
                <div class="order-list-brand-detail">
                    <div class="order-list-brand-item">
                        <img class="order-list-brand-item-img" src="<?= $product['imgPath'] ?>" alt="">
                        <div class="order-list-brand-item-des">
                            <span class="order-list-brand-item-title"><?= $product['prodName'] ?></span>
                            <p class="order-list-brand-item-des"><?= $product['prodDescrip'] ?></p>
                        </div>
                        <p class="order-list-brand-item-num"><?= $product['prodNumber'] ?></p>
                        <div class="order-list-brand-item-price"><?= $product['prodOldPrice'] ?></div>
                    </div>
                </div>
                <?php }
                
                    endforeach; ?>
            </div>
            <?php endforeach; ?>
    
    <?php 
            $num = 0;
            $total = 0;
            $i = 1;
            $max = count($products);
            foreach ($products as $product) :
                if($i == $max) {
                $num = $num + $product['prodNumber'];
                $total = $total + ($product['prodNumber'] * $product['prodOldPrice'])
        ?>
        <div class="order-detail-item-total">
            <div class="order-detail-item-total-num">
                <span class="title-num">Số lượng:</span>
                <p class="total-num"><?= $num?> sản phẩm</p>
            </div>
            <div class="order-detail-item-total-detail">
                <span class="title-detail">Thành tiền:</span>
                <p class="total-detail"><?= $total?> (VND)</p>
            </div>
        </div>
        <?php } else $i++; 
                $num = $num + $product['prodNumber'];
                $total = $total + ($product['prodNumber'] * $product['prodOldPrice']);
            endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="ad_order.js"></script>
</body>
</html>