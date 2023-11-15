<?php
require_once "order-pdo.php";
$order = new Order();
// print_r($order->getData(null,null));
?>

<head>
    <meta charset="UTF-8">
    <title>Đơn hàng</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/images/logo-shortcut.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    body {
        font-family: "Inter";
        height: 100vh;
        min-height: 100vh;
    }

    .box {
        border-radius: 20px;
        background: #FFF;
        box-shadow: 0px 4px 40px 0px rgba(0, 0, 0, 0.10);
    }

    .order-list {
        display: flex;
        justify-content: space-between;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .slide {
        animation: slide 0.5s;
    }

    #container-slide {
        position: absolute;
        left: var(--transitionto)
    }

    @keyframes slide {
        from {
            left: var(--last)
        }

        to {
            left: var(--transitionto)
        }
    }
</style>

<body>
<div class="bg-[#505050] bg-opacity-[40%] h-[100vh] w-[100vw] fixed z-10 flex flex-col justify-center items-center hidden" id="popupCf">
        <div class="bg-white absolute p-[40px] flex flex-col justify-center rounded-[8px]">
            <span class="text-[#0091D0] text-[18px] font-[600] mb-2 flex justify-center">XOÁ SẢN PHẨM ĐÃ CHỌN?</span>
            <span class="text-[#505050] text-[13px] mb-4 flex justify-center">Bạn chắc chắn muốn xoá sản phẩm đã chọn?</span>
            <div class="flex w-full justify-center">
                <button class="bg-white border border-solid text-[13px] border-[#d8d8d8] rounded-[8px] mr-4 py-[8px] px-[12px] " onclick="document.getElementById('popupCf').classList.toggle('hidden')">Huỷ bỏ</button>
                <button class="bg-[#0091D0] text-white border border-solid text-[13px] border-[#d8d8d8] rounded-[8px] py-[8px] px-[12px]" onclick="window.location.href='http://localhost/PharmaDI-Admin/order/action-delete.php?prodId=<?= $_GET['orderId'] ?>'">Xác nhận</button>
            </div>
        </div>
    </div>
    <form method="POST" id='form-order-search' action="action-edit.php?orderId=<?=$_GET['orderId']?>" class="flex justify-between">
        <div class="max-h min-h-vh">
            <?php require_once '../menu.php'; ?>
        </div>
        <div class="bg-white m-8 box w-full text-[#505050]">
            <div class="flex justify-between w-full px-[50px] py-3 flex-col text-[#505050]">
                <div class="bg-white flex flex-col py-8 rounded-[10px] w-full max-h-max">
                    <div class="flex items-center text-[14px]">
                        <span class="px-1 cursor-pointer"
                            onclick="window.location.href='http://localhost/PharmaDI-Admin/order/order-list.php'">Danh
                            sách đơn hàng</span>
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="#505050" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M1.09327 0.692102C1.35535 0.467463 1.74991 0.497814 1.97455 0.759893L6.97455 6.59323C7.17517 6.82728 7.17517 7.17266 6.97455 7.40672L1.97455 13.24C1.74991 13.5021 1.35535 13.5325 1.09327 13.3078C0.831188 13.0832 0.800837 12.6886 1.02548 12.4266L5.67684 6.99997L1.02548 1.57338C0.800837 1.3113 0.831188 0.916741 1.09327 0.692102Z"
                                fill="#505050" />
                        </svg>

                        <span class="px-1 cursor-pointer"
                            onclick="window.location.href='http://localhost/PharmaDI-Admin/order/order-detail.php?orderId=<?= $_GET['orderId'] ?>'">Chi
                            tiết đơn hàng</span>
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M1.09327 0.692102C1.35535 0.467463 1.74991 0.497814 1.97455 0.759893L6.97455 6.59323C7.17517 6.82728 7.17517 7.17266 6.97455 7.40672L1.97455 13.24C1.74991 13.5021 1.35535 13.5325 1.09327 13.3078C0.831188 13.0832 0.800837 12.6886 1.02548 12.4266L5.67684 6.99997L1.02548 1.57338C0.800837 1.3113 0.831188 0.916741 1.09327 0.692102Z"
                                fill="#0091D0" />
                        </svg>
                        <span class="text-[#0091D0] px-1 font-[600]">Chỉnh sửa đơn hàng</span>
                    </div>
                    <div class="flex justify-between items-center text-[#0091D0] pt-[25px]">
                        <span class="text-[#0091D0] font-[600]">CHỈNH SỬA ĐƠN HÀNG</span>
                        <button type="button"
                        onclick="document.getElementById('popupCf').classList.toggle('hidden')"
                            class="flex items-center border-[#15A5E3] border border-solid px-[12px] py-[5px] text-[13px] rounded-[8px] text-[#0091D0]">Xoá đơn hàng
                        </button>
                    </div>
                    <div class="flex w-full">
                        <div class="flex flex-col w-full mr-3">
                            <span class="text-[14px] font-[500] text-[#505050] py-1 pt-2 ml-2">Tên nhà thuốc</span>
                            <input type="text" value="<?= $order->detail($_GET['orderId'])[0]['cusName'] ?>" readonly
                                width="350px"
                                class="mr-14 bg-[#f2f2f2] px-2.5 pl-[10px] py-[6px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[14px]">
                        </div>
                        <div class="flex flex-col w-full ">
                            <span class="text-[14px] font-[500] text-[#505050] py-1 pt-2 ml-2">Người liên hệ</span>
                            <input type="text" value="<?= $order->detail($_GET['orderId'])[0]['cusContact'] ?>" readonly
                                width="350px"
                                class="px-2.5 bg-[#f2f2f2] pl-[10px] py-[6px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[14px]">
                        </div>
                    </div>
                    <div class="flex w-full">
                        <div class="flex flex-col w-full mr-3">
                            <span class="text-[14px] font-[500] text-[#505050] py-1 pt-2 ml-2">Ngày đặt hàng</span>
                            <input type="text" value="<?= $order->detail($_GET['orderId'])[0]['orderDate'] ?>" readonly
                                width="350px"
                                class="mr-14 bg-[#f2f2f2] px-2.5 pl-[10px] py-[6px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[14px]">
                        </div>
                        <div class="flex flex-col w-full relative cursor-pointer"
                            onclick="showDroplist('status-droplist')" id='status-order'>
                            <span class="text-[14px] font-[500] text-[#505050] py-1 pt-2 ml-2">Trạng thái đơn
                                hàng</span>
                            <input type="text" readonly name="orderStatus"
                                value="<?= $order->detail($_GET['orderId'])[0]['orderStatus'] == 1 ? "Chờ xác nhận" : ($order->detail($_GET['orderId'])[0]['orderStatus'] == 2 ? "Đã xác nhận" : ($order->detail($_GET['orderId'])[0]['orderStatus'] == 3 ? "Đang giao hàng" : ($order->detail($_GET['orderId'])[0]['orderStatus'] == 4 ? "Đã giao hàng" : "Đã huỷ"))) ?>"
                                class="cursor-pointer px-2.5 pl-[10px] py-[6px] w-full border border-solid hidden border-[#d8d8d8] rounded-[6px] outline-0 text-[14px]">
                            <input type="text" readonly 
                                value="<?= $order->detail($_GET['orderId'])[0]['orderStatus'] == 1 ? "Chờ xác nhận" : ($order->detail($_GET['orderId'])[0]['orderStatus'] == 2 ? "Đã xác nhận" : ($order->detail($_GET['orderId'])[0]['orderStatus'] == 3 ? "Đang giao hàng" : ($order->detail($_GET['orderId'])[0]['orderStatus'] == 4 ? "Đã giao hàng" : "Đã huỷ"))) ?>"
                                class="cursor-pointer px-2.5 pl-[10px] py-[6px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[14px]">
                            <svg class="absolute right-[10px] top-[45px]" width="15" height="15" viewBox="0 0 15 15"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2.76911 5.31995C2.93759 5.12339 3.23351 5.10063 3.43007 5.26911L7.50001 8.75763L11.57 5.26911C11.7665 5.10063 12.0624 5.12339 12.2309 5.31995C12.3994 5.51651 12.3766 5.81243 12.1801 5.98091L7.80507 9.73091C7.62953 9.88138 7.37049 9.88138 7.19495 9.73091L2.81995 5.98091C2.62339 5.81243 2.60063 5.51651 2.76911 5.31995Z"
                                    fill="#1C274C" />
                            </svg>
                            <div class="absolute flex flex-col bg-white py-2 rounded-[6px] border border-[#d8d8d8] text-[13px] hidden top-[70px] w-full z-10"
                                id="status-droplist">
                                <span class="hover:bg-gray-100 px-[20px] py-[3px] text-[#505050]"
                                    onclick="select('status-order', 1, 'Chờ xác nhận')">Chờ xác nhận</span>
                                <span class="hover:bg-gray-100 px-[20px] py-[3px] text-[#505050]"
                                    onclick="select('status-order', 2, 'Đã xác nhận')">Đã xác nhận</span>
                                <span class="hover:bg-gray-100 px-[20px] py-[3px] text-[#505050]"
                                    onclick="select('status-order', 3, 'Đang giao hàng')">Đang giao hàng</span>
                                <span class="hover:bg-gray-100 px-[20px] py-[3px] text-[#505050]"
                                    onclick="select('status-order', 4, 'Đã giao hàng')">Đã giao hàng</span>
                                <span class="hover:bg-gray-100 px-[20px] py-[3px] text-[#505050]"
                                    onclick="select('status-order', 5, 'Đã huỷ')">Đã huỷ</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full">
                        <div class="flex flex-col w-full mr-3">
                            <span class="text-[14px] font-[500] text-[#505050] py-1 pt-2 ml-2">Số điện thoại</span>
                            <input type="text" value="<?= $order->detail($_GET['orderId'])[0]['cusPhone'] ?>" readonly
                                width="350px"
                                class="mr-14 bg-[#f2f2f2] px-2.5 pl-[10px] py-[6px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[14px]">
                        </div>
                        <div class="flex flex-col w-full">
                            <span class="text-[14px] font-[500] text-[#505050] py-1 pt-2 ml-2">Địa chỉ</span>
                            <input type="text" value="<?= $order->detail($_GET['orderId'])[0]['cusAddress'] ?>" readonly
                                width="350px"
                                class="px-2.5 bg-[#f2f2f2] pl-[10px] py-[6px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[14px]">
                        </div>
                    </div>
                    <div class="flex flex-col mt-1 w-full">
                        <span class="text-[14px] font-[500] text-[#505050] py-1 pt-3 ml-2">Ghi chú</span>
                        <input type="text" value="<?= $order->detail($_GET['orderId'])[0]['orderNote'] ?>" readonly
                            class="flex border bg-[#f2f2f2] border-solid rounded-[6px] border-[#d8d8d8] px-2.5 w-full h-[50px] text-[14px]">
                    </div>
                    <div
                        class="flex flex-col mt-4 border border-solid border-[#d8d8d8] py-4 px-6 rounded-[6px] text-[#505050]">
                        <?php foreach ($order->brandInOrder($_GET['orderId']) as $brand): ?>
                            <span class="text-[18px] font-[600] text-[#505050] pb-2">
                                <?= $brand['brandName'] ?>
                            </span>
                            <div
                                class="flex grid grid-cols-12 text-[14px] pt-2 pb-2 border-solid border-[#f6f6f6] font-[600]">
                                <span class="col-span-7">Tên sản phẩm</span>
                                <span class="col-span-3">Số lượng</span>
                                <span class="col-span-2">Đơn giá</span>
                            </div>
                            <?php foreach ($order->detail($_GET['orderId']) as $v):
                                if ($v['brandName'] == $brand['brandName'])
                                ?>
                                <div
                                    class="flex grid grid-cols-12 text-[14px] pt-2 border-t-2 pb-2 border-solid border-[#f6f6f6]">
                                    <div class="col-span-7 flex">
                                        <img class="object-cover h-[70px] w-[70px] pr-2" src="<?= $v['imgPath'] ?>" alt="">
                                        <span class="pl-2 pt-2">
                                            <?= $v['prodName'] ?>
                                        </span>
                                    </div>
                                    <span class="col-span-3 pt-2">
                                        <?= $v['prodNumber'] ?>
                                    </span>
                                    <span class="col-span-2 pt-2">
                                        <?= number_format($v['prodOldPrice']) ?> VND
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach ?>
                    </div>
                    <div
                        class="flex flex-col text-[14px] border border-solid border-[#d8d8d8] rounded-[6px] py-2 mt-4 px-2.5">
                        <div class="flex justify-between pb-1">
                            <span>Số lượng</span>
                            <span>
                                <?= $order->detail($_GET['orderId'])[0]['num'] ?> (sản phẩm)
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-[600]"> Thành tiền </span>
                            <span class="font-[600] text-[#0071AF]">
                                <?= number_format($order->detail($_GET['orderId'])[0]['total']) ?> VND
                            </span>
                        </div>
                    </div>
                    <div class="justify-end flex mt-5">
                        <button
                            class="text-[12px] border border-solid border-[#d8d8d8] rounded-[6px] px-[14px] py-[7px] mr-3">Huỷ
                            bỏ</button>
                        <button class="text-[12px] bg-[#15A5E3] text-white rounded-[6px] px-[14px] py-[7px]"
                            type="submit">Lưu thay đổi</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
<script>
    function showDroplist(id) {
        var dropList = document.getElementById(id);
        dropList.classList.toggle('hidden');
    }
    function select(id, value, label) {
        var dom = document.getElementById(id);
        dom.getElementsByTagName('input')[0].value = value;
        dom.getElementsByTagName('input')[1].value = label;
    }
    function submitForm(id) {
        document.getElementById(id).submit()
    }
</script>
<?php
?>