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
    <title>Chi tiết khách hàng</title>
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
    <form method="GET" id='form-news-search' class="flex justify-between">
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
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.09327 0.692102C1.35535 0.467463 1.74991 0.497814 1.97455 0.759893L6.97455 6.59323C7.17517 6.82728 7.17517 7.17266 6.97455 7.40672L1.97455 13.24C1.74991 13.5021 1.35535 13.5325 1.09327 13.3078C0.831188 13.0832 0.800837 12.6886 1.02548 12.4266L5.67684 6.99997L1.02548 1.57338C0.800837 1.3113 0.831188 0.916741 1.09327 0.692102Z"
                            fill="#0091D0" />
                    </svg>
                    <span class="text-[#0091D0] px-1 font-[600]">Chi tiết khách hàng</span>
                </div>
                <!-- Title -->
                <div class="flex justify-between items-center py-[25px]">
                    <span class="text-[#0091D0] font-[600]">CHI TIẾT KHÁCH HÀNG</span>
                    <button type="button"
                        onclick="window.location.href='http://localhost/PharmaDI-Admin/customer/customer-edit.php?cusId=<?= $cus['cusId'] ?>'"
                        class="border-[#15A5E3] border border-solid px-[12px] py-[5px] text-[13px] rounded-[8px] text-[#0091D0]">Chỉnh
                        sửa</button>
                </div>
                <div class="flex items-center w-full">
                    <div class="flex flex-col w-full mr-5">
                        <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Tên khách hàng</span>
                        <input type="text" name="newsTitle" readonly value="<?= $cus['cusName'] ?>" readonly
                        class="px-2.5 bg-[#f2f2f2] pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">
                        
                    </div>
                    <div class="flex flex-col w-full ">
                        <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Trạng thái</span>
                        <input type="text" name="newsTitle" readonly value="<?= $cus['cusStatus'] == 0 ? "Đã duyệt" : ($cus['cusStatus'] == 0 ? "Chờ duyệt" : "Không duyệt") ?>" readonly
                            class="px-2.5 bg-[#f2f2f2] pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">

                    </div>
                </div>
                <div class="flex items-center w-full mt-3">
                    <div class="flex flex-col w-full mr-5">
                        <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Tên người liên hệ</span>
                        <input type="text" name="" readonly value="<?= $cus['cusContact'] ?>" readonly
                            class="px-2.5 bg-[#f2f2f2] pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">
                    </div>
                    <div class="flex flex-col w-full">
                        <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Số điện thoại</span>
                        <input type="text" name="" readonly value="<?= $cus['cusPhone'] ?>" readonly
                            class="px-2.5 bg-[#f2f2f2] pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">
                    </div>
                </div>
                <div class="flex flex-col w-full mt-3">
                    <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Địa chỉ</span>
                    <input type="text" name="" readonly value="<?= $cus['cusAddress'] ?>" readonly
                        class="px-2.5 bg-[#f2f2f2] pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">
                </div>
                <div class="flex items-center w-full mt-3">
                    <div class="flex flex-col w-full mr-5">
                        <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Số GPP</span>
                        <input type="text" name="" readonly value="<?= $cus['cusGPP'] ?>" readonly
                            class="px-2.5 bg-[#f2f2f2] pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">
                    </div>
                    <div class="flex flex-col w-full">
                        <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Ngày cấp</span>
                        <input type="date" name="" readonly value="<?= $cus['cusGPPDate'] ?>" readonly
                            class="px-2.5 bg-[#f2f2f2] pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">
                    </div>
                </div>
                <div class="flex flex-col w-full mt-3">
                    <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Nơi cấp</span>
                    <input type="text" name="" readonly value="<?= $cus['cusGPPAddr'] ?>" readonly
                        class="px-2.5 bg-[#f2f2f2] pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">
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