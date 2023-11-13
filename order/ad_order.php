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
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex justify-between">
        <div class="menu bg-[#0091D0] w-[13%] max-h min-h-vh">
            <?php require_once '../menu.php'; ?>
        </div>
        <div class="content 87%">
            <div
                class="flex justify-between items-center w-full border-solid border-[#d8d8d8] border pb-2.5 pt-2 shadow-md">
                <svg class="mx-[40px]" width="30" height="31" viewBox="0 0 30 31" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M25.9375 9.25C25.9375 9.76777 25.5178 10.1875 25 10.1875L5 10.1875C4.48223 10.1875 4.0625 9.76777 4.0625 9.25C4.0625 8.73223 4.48223 8.3125 5 8.3125L25 8.3125C25.5178 8.3125 25.9375 8.73223 25.9375 9.25Z"
                        fill="#0091D0" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M25.9375 15.5C25.9375 16.0178 25.5178 16.4375 25 16.4375L5 16.4375C4.48223 16.4375 4.0625 16.0178 4.0625 15.5C4.0625 14.9822 4.48223 14.5625 5 14.5625L25 14.5625C25.5178 14.5625 25.9375 14.9822 25.9375 15.5Z"
                        fill="#0091D0" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M25.9375 21.75C25.9375 22.2678 25.5178 22.6875 25 22.6875L5 22.6875C4.48223 22.6875 4.0625 22.2678 4.0625 21.75C4.0625 21.2322 4.48223 20.8125 5 20.8125L25 20.8125C25.5178 20.8125 25.9375 21.2322 25.9375 21.75Z"
                        fill="#0091D0" />
                </svg>
                <div class="flex justify-between items-center p-[5px] mx-[40px] ">
                    <span
                        style="padding: 0 5px; font-size: 14px; cursor-pointer; color: #0091D0; border: 1px solid #0091D0; border-radius: 8px; padding: 5px 12px"
                        onclick="window.location.href='http://localhost/PharmaDI-Enduser/log-out.php'">Đăng xuất</span>
                </div>
            </div>
            <form method="GET" action="">
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
                    <button type="submit">Tìm kiếm</button>
                </div>
            </form>

            <?php
            if (isset($_GET["submit"])) {
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
                        foreach ($searchs as $search): ?>
                            <tr>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $i++ ?></a></td>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $search['orderId'] ?></a></td>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $search['orderDate'] ?></a></td>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $search['cusName'] ?></a></td>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $search['cusPhone'] ?></a></td>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $search['cusGPPAddr'] ?></a></td>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $search['prodNumber'] * $search['prodOldPrice'] ?></a></td>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?php if ($search['orderStatus'] == 1)
                                       echo "Chờ xác nhận";
                                   else if ($search['orderStatus'] == 2)
                                       echo "Đã xác nhận";
                                   else if ($search['orderStatus'] == 3)
                                       echo "Đang giao hàng";
                                   else if ($search['orderStatus'] == 4)
                                       echo "Đã giao hàng";
                                   else if ($search['orderStatus'] == 5)
                                       echo "Huỷ đơn hàng";
                                   ?></a></td>
                            </tr>
                        <?php endforeach; ?>
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
                        foreach ($products as $product): ?>
                            <tr>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $i++ ?></a></td>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $product['orderId'] ?></a></td>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $product['orderDate'] ?></a></td>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $product['cusName'] ?></a></td>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $product['cusPhone'] ?></a></td>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $product['cusGPPAddr'] ?></a></td>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?= $product['prodNumber'] * $product['prodOldPrice'] ?></a></td>
                                <td><a href="ad_order_detail.php?id=<?php echo $product["orderId"] ?>"><?php if ($product['orderStatus'] == 1)
                                       echo "Chờ xác nhận";
                                   else if ($product['orderStatus'] == 2)
                                       echo "Đã xác nhận";
                                   else if ($product['orderStatus'] == 3)
                                       echo "Đang giao hàng";
                                   else if ($product['orderStatus'] == 4)
                                       echo "Đã giao hàng";
                                   else if ($product['orderStatus'] == 5)
                                       echo "Huỷ đơn hàng";
                                   ?></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php } ?>


            
        </div>
        <script src="ad_order.js"></script>
    </div>
</body>

</html>