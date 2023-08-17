<!DOCTYPE html>
<html lang="en">
<?php
require_once "customer-pdo.php";
$customer = new customer();
$cus = $customer->cusDetail($_GET['cusId']);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../asset/image/logo-shortcut.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Chỉnh sửa khách hàng</title>
    <style>
        body {
            font-family: "Inter";
            height: 100vh;
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <div class="flex justify-between">
        <div class="menu bg-[#0071AF] w-[13%] max-h">
            <?php require_once "../menu.php"; ?>
        </div>
        <form class="w-[87%]" method="POST" action="action-edit.php">
            <!-- Menu -->
            <div
                class="flex justify-between items-center w-full border-solid border-[#d8d8d8] border pb-2.5 pt-2 shadow-md">
                <svg class="mx-[40px]" width="30" height="31" viewBox="0 0 30 31" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M25.9375 9.25C25.9375 9.76777 25.5178 10.1875 25 10.1875L5 10.1875C4.48223 10.1875 4.0625 9.76777 4.0625 9.25C4.0625 8.73223 4.48223 8.3125 5 8.3125L25 8.3125C25.5178 8.3125 25.9375 8.73223 25.9375 9.25Z"
                        fill="#0071AF" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M25.9375 15.5C25.9375 16.0178 25.5178 16.4375 25 16.4375L5 16.4375C4.48223 16.4375 4.0625 16.0178 4.0625 15.5C4.0625 14.9822 4.48223 14.5625 5 14.5625L25 14.5625C25.5178 14.5625 25.9375 14.9822 25.9375 15.5Z"
                        fill="#0071AF" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M25.9375 21.75C25.9375 22.2678 25.5178 22.6875 25 22.6875L5 22.6875C4.48223 22.6875 4.0625 22.2678 4.0625 21.75C4.0625 21.2322 4.48223 20.8125 5 20.8125L25 20.8125C25.5178 20.8125 25.9375 21.2322 25.9375 21.75Z"
                        fill="#0071AF" />
                </svg>
                <div class="flex justify-between items-center p-[5px] mx-[40px] ">
                    <span style="padding: 0 5px; font-size: 14px; cursor-pointer; color: #0071AF; border: 1px solid #0071AF; border-radius: 8px; padding: 5px 12px" onclick="window.location.href='http://localhost/PharmaDI-Enduser/log-out.php'">Đăng xuất</span>
                </div>
            </div>
            <!-- Content -->
            <div class="flex flex-col px-[40px] py-[20px] text-[#505050]">
                <!-- Breadscumb -->
                <div class="flex items-center text-[14px]">
                    <span class="px-1 cursor-pointer"
                        onclick="window.location.href='http://localhost/PharmaDI-Admin/customer/customer-list.php'">Danh
                        sách khách hàng</span>
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.09327 0.692102C1.35535 0.467463 1.74991 0.497814 1.97455 0.759893L6.97455 6.59323C7.17517 6.82728 7.17517 7.17266 6.97455 7.40672L1.97455 13.24C1.74991 13.5021 1.35535 13.5325 1.09327 13.3078C0.831188 13.0832 0.800837 12.6886 1.02548 12.4266L5.67684 6.99997L1.02548 1.57338C0.800837 1.3113 0.831188 0.916741 1.09327 0.692102Z"
                            fill="#0071AF" />
                    </svg>
                    <span class="text-[#0071AF] px-1 font-[600]">Chỉnh sửa khách hàng</span>
                </div>
                <!-- Title -->
                <div class="flex justify-between items-center py-[25px]">
                    <span class="text-[#0071AF] font-[600]">CHỈNH SỬA KHÁCH HÀNG</span>
                </div>
                <!-- Textbox -->
                <div class="flex justify-between mt-1">
                    <div class="relative">
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Mã khách hàng</span>
                        <input  readonly type="text" value="<?= $cus['cusId']?>" name="cusId" class="px-2.5 pl-[20px] py-[8px] w-[600px] border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px]">
                    </div>
                    <div class="relative" onclick="showDroplist('status-droplist')" id='status-cus'>
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Trạng thái</span>
                        <input type="text" value="<?= $cus['cusStatus'] ?>" class="hidden" name="cusStatus">
                        <input type="text" 
                            value="<?= $cus['cusStatus'] == 1 ? "Đã duyệt" : ($cus['cusStatus'] == 0 ? "Chờ duyệt" : "Không duyệt") ?>"
                            class="cursor-pointer px-2.5 pl-[20px] py-[8px] w-[600px] border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border focus-within:border-solid focus-within:border-[#0071AF] outline-0 text-[13px]">
                        <svg class="absolute right-[10px] top-[11px]" width="15" height="15" viewBox="0 0 15 15"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.76911 5.31995C2.93759 5.12339 3.23351 5.10063 3.43007 5.26911L7.50001 8.75763L11.57 5.26911C11.7665 5.10063 12.0624 5.12339 12.2309 5.31995C12.3994 5.51651 12.3766 5.81243 12.1801 5.98091L7.80507 9.73091C7.62953 9.88138 7.37049 9.88138 7.19495 9.73091L2.81995 5.98091C2.62339 5.81243 2.60063 5.51651 2.76911 5.31995Z"
                                fill="#1C274C" />
                        </svg>
                        <div class="absolute flex flex-col bg-white py-2 rounded-[6px] border border-[#d8d8d8] text-[13px] hidden w-[280px] z-10"
                            id="status-droplist">
                            <span class="hover:bg-gray-100 px-[20px] py-[3px] text-[#505050]"
                                onclick="select('status-cus', 1, 'Đã duyệt')">Đã duyệt</span>
                            <span class="hover:bg-gray-100 px-[20px] py-[3px] text-[#505050]"
                                onclick="select('status-cus', 0, 'Chờ duyệt')">Chờ duyệt</span>
                            <span class="hover:bg-gray-100 px-[20px] py-[3px] text-[#505050]"
                                onclick="select('status-cus', 2, 'Không duyệt')">Không duyệt</span>
                        </div>
                    </div>
                </div>
                <div class="relative flex justify-between mt-5 w-full">
                    <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Tên nhà thuốc</span>
                    <input type="text" name = "cusName" value="<?= $cus['cusName']?>"  
                        class="px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px]  outline-0 text-[13px]">
                </div>
                <div class="flex justify-between mt-5">
                    <div class="relative">
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Tên người liên hệ</span>
                        <input   value="<?= $cus['cusContact']?>" type="text" name="cusContact" class="px-2.5 pl-[20px] py-[8px] w-[600px] border border-solid border-[#d8d8d8] rounded-[6px]  outline-0 text-[13px]">
                    </div>
                    <div class="relative">
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Số điện thoại</span>
                        <input type="text" value="<?= $cus['cusPhone']?>" name="cusPhone"
                            class="px-2.5 pl-[20px] py-[8px] w-[600px] border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px]"
                             >
                    </div>
                </div>
                <div class="relative flex justify-between mt-5 w-full">
                    <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Địa chỉ</span>
                    <input type="text" name = "cusAddress" value="<?= $cus['cusAddress']?>"  
                        class="px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px]  outline-0 text-[13px]">
                </div>
                <div class="flex justify-between mt-5">
                    <div class="relative">
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Số GPP</span>
                        <input   type="text" value="<?= $cus['cusGPP']?>" name="cusGPP" class="px-2.5 pl-[20px] py-[8px] w-[400px] border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px]">
                    </div>
                    <div class="relative">
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Ngày cấp</span>
                        <input type="text" name="cusGPPDate" value="<?= $cus['cusGPPDate']?>"
                            class="px-2.5 pl-[20px] py-[8px] w-[400px] border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px]"
                            value="Chờ duyệt"  >
                        </svg>
                    </div>
                    <div class="relative">
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Nơi cấp</span>
                        <input type="text" name="cusGPPAddr" value="<?= $cus['cusGPPAddr']?>"
                            class="px-2.5 pl-[20px] py-[8px] w-[400px] border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px]"
                            value="Chờ duyệt"  >
                        </svg>
                    </div>
                </div>
                <div class="justify-end flex mt-5">
                <button type="button" onclick="window.location.href = 'http://localhost/PharmaDI-Admin/customer/customer-detail.php?cusId=<?= $cus['cusId'] ?>'"
                        class="text-[12px] border border-[#d8d8d8]  rounded-[6px] px-[14px] py-[7px] mr-3 text-[#505050]">Huỷ bỏ</button>
                    <button type="submit"
                        class="text-[12px] bg-[#15A5E3] text-white rounded-[6px] px-[14px] py-[7px]">Chỉnh sửa</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
<script>
    function showDroplist(id) {
        var dropList = document.getElementById(id);
        dropList.classList.toggle('hidden');
        console.log(dropList.getElementsByTagName('span'))
    }

    function select(id, value, label) {
        var dom = document.getElementById(id);
        dom.getElementsByTagName('input')[0].value = value;
        dom.getElementsByTagName('input')[1].value = label;
    }

    var file = document.getElementById('image');

    function getImage(){
        file.click();
    }

    function getImageInfo(){
        document.getElementById('imgName').innerHTML = file.files[0].name;
        let fileReader = new FileReader();
        fileReader.readAsDataURL(file.files[0])
        fileReader.onload = (e) => {
            console.log(e)
            var img = document.createElement('img');
            img.src = e.target.result
            img.style.objectFit = 'cover'
            img.style.maxWidth = '100%'
            document.getElementById('imgContainer').appendChild(img)
            document.getElementById('imgContainer').classList.toggle('hidden')
            document.getElementById('img').classList.toggle('hidden')
        }
    }
</script>