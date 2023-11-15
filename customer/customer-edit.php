<?php
require "customer-pdo.php";
$customer = new Customer();
$cus = $customer->cusDetail($_GET['cusId']);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/images/logo-shortcut.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Chỉnh sửa khách hàng</title>
</head>
<style>
    body {
        font-family: "Inter";
        height: 100vh;
        min-height: 100vh;
    }

    .news-list {
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
    <form method="POST" action="action-edit.php?cusId=<?=$_GET['cusId']?>" class="flex justify-between">
        <div class="max-h min-h-vh">
            <?php require_once '../menu.php'; ?>
        </div>
        <div class="bg-white m-8 box w-full">
            <!--Search-->
            <div class="flex justify-between w-full mt-5 px-[50px] py-[25px] flex-col text-[#505050]">
                <!-- Breadscumb -->
                <div class="flex items-center text-[14px]">
                    <span class="px-1 cursor-pointer"
                        onclick="window.location.href='http://localhost/PharmaDI-Admin/customer/customer-list.php'">Danh
                        sách khách hàng</span>
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="#505050" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.09327 0.692102C1.35535 0.467463 1.74991 0.497814 1.97455 0.759893L6.97455 6.59323C7.17517 6.82728 7.17517 7.17266 6.97455 7.40672L1.97455 13.24C1.74991 13.5021 1.35535 13.5325 1.09327 13.3078C0.831188 13.0832 0.800837 12.6886 1.02548 12.4266L5.67684 6.99997L1.02548 1.57338C0.800837 1.3113 0.831188 0.916741 1.09327 0.692102Z"
                            fill="#505050" />
                    </svg>
                    <span class="text-[#505050] px-1">Chi tiết khách hàng</span>
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.09327 0.692102C1.35535 0.467463 1.74991 0.497814 1.97455 0.759893L6.97455 6.59323C7.17517 6.82728 7.17517 7.17266 6.97455 7.40672L1.97455 13.24C1.74991 13.5021 1.35535 13.5325 1.09327 13.3078C0.831188 13.0832 0.800837 12.6886 1.02548 12.4266L5.67684 6.99997L1.02548 1.57338C0.800837 1.3113 0.831188 0.916741 1.09327 0.692102Z"
                            fill="#0091D0" />
                    </svg>
                    <span class="text-[#0091D0] px-1 font-[600]">Chỉnh sửa khách hàng</span>
                </div>
                <!-- Title -->
                <div class="flex justify-between items-center py-[25px]">
                    <span class="text-[#0091D0] font-[600]">CHỈNH SỬA KHÁCH HÀNG</span>
                </div>
                <div class="flex items-center w-full">
                    <div class="flex flex-col w-full mr-5">
                        <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Tên khách hàng</span>
                        <input type="text" name="cusName" value="<?= $cus['cusName'] ?>"
                            class="px-2.5 pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">

                    </div>
                    <div class="relative flex flex-col w-full" onclick="showDroplist('status-droplist')" id='status-customer'>
                        <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Trạng thái</span>
                        <input type="text" value="<?=$cus['cusStatus']?>" class="hidden" name="cusStatus">
                        <input type="text" readonly
                            value="<?= $cus['cusStatus'] == 0 ? "Đã duyệt" : ($cus['cusStatus'] == 1 ? "Chờ duyệt" : "Không duyệt") ?>" readonly
                            class="px-2.5 pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">
                        <svg class="absolute right-[10px] top-[37px]" width="15" height="15" viewBox="0 0 15 15"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.76911 5.31995C2.93759 5.12339 3.23351 5.10063 3.43007 5.26911L7.50001 8.75763L11.57 5.26911C11.7665 5.10063 12.0624 5.12339 12.2309 5.31995C12.3994 5.51651 12.3766 5.81243 12.1801 5.98091L7.80507 9.73091C7.62953 9.88138 7.37049 9.88138 7.19495 9.73091L2.81995 5.98091C2.62339 5.81243 2.60063 5.51651 2.76911 5.31995Z"
                                fill="#1C274C" />
                        </svg>
                        <div class="top-[65px] absolute flex flex-col bg-white py-2 rounded-[6px] border border-[#d8d8d8] text-[13px] hidden w-full z-10"
                            id="status-droplist">
                            <span class="hover:bg-gray-100 px-[20px] py-[3px] text-[#505050]"
                                onclick="select('status-customer', 0, 'Đã duyệt')">Đã duyệt</span>
                            <span class="hover:bg-gray-100 px-[20px] py-[3px] text-[#505050]"
                                onclick="select('status-customer', 1, 'Chờ duyệt')">Chờ duyệt</span>
                            <span class="hover:bg-gray-100 px-[20px] py-[3px] text-[#505050]"
                                onclick="select('status-customer', 3, 'Không duyệt')">Không duyệt</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center w-full mt-3">
                    <div class="flex flex-col w-full mr-5">
                        <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Tên người liên hệ</span>
                        <input type="text" name="cusContact" value="<?= $cus['cusContact'] ?>"
                            class="px-2.5 pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">
                    </div>
                    <div class="flex flex-col w-full">
                        <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Số điện thoại</span>
                        <input type="text" name="cusPhone" value="<?= $cus['cusPhone'] ?>"
                            class="px-2.5 pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">
                    </div>
                </div>
                <div class="flex flex-col w-full mt-3">
                    <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Địa chỉ</span>
                    <input type="text" name="cusAddress" value="<?= $cus['cusAddress'] ?>"
                        class="px-2.5 pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">
                </div>
                <div class="flex items-center w-full mt-3">
                    <div class="flex flex-col w-full mr-5">
                        <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Số GPP</span>
                        <input type="text" name="cusGPP" value="<?= $cus['cusGPP'] ?>"
                            class="px-2.5 pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">
                    </div>
                    <div class="flex flex-col w-full">
                        <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Ngày cấp</span>
                        <input type="date" name="cusGPPDate" value="<?= $cus['cusGPPDate'] ?>"
                            class="px-2.5 pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">
                    </div>
                </div>
                <div class="flex flex-col w-full mt-3">
                    <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Nơi cấp</span>
                    <input type="text" name="cusGPPAddr" value="<?= $cus['cusGPPAddr'] ?>"
                        class="px-2.5 pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">
                </div>
                <div class="justify-end flex mt-5">
                    <button onclick="window.location.href='http://localhost/PharmaDI-Admin/customer/customer-list.php'"
                        class="text-[12px] border border-solid border-[#d8d8d8] rounded-[6px] px-[14px] py-[7px] mr-3">Huỷ
                        bỏ</button>
                    <button class="text-[12px] bg-[#15A5E3] text-white rounded-[6px] px-[14px] py-[7px]"
                        type="submit">Lưu thay đổi</button>
                </div>
            </div>
            <div class="flex flex-col px-[50px] py-[25px]">
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
    function changePageSize(value) {
        console.log(value)
    }
    function submitForm(id) {
        document.getElementById(id).submit()
    }
</script>
<?php
?>