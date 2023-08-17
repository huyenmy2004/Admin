<?php
require_once "customer-pdo.php";
$customer = new Customer();
if (isset($_GET['search-prodName']) || isset($_GET['search-status']))
    $customers = $customer->getData($_GET['search-prodName'], $_GET['search-status']);
else {
    $customers = $customer->getData(null, null);
}
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 10;
if (count($customers) <= ($page - 1) * $pageSize) {
    $page = 1;
}
?>

<head>
    <meta charset="UTF-8">
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

    .product-list {
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
    <form method="GET" id='form-product-search' class="flex justify-between">
    <div class="menu bg-[#0071AF] w-[13%] max-h min-h-vh">
            <?php require_once '../menu.php'; ?>
        </div>
        <div class="w-[87%]">
            <!--Menu-->
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
            <!--Search-->
            <div class="flex mt-6 justify-between w-full">
                <div class="w-full flex justify-between">
                    <div class="relative ml-10 w-[20%]">
                        <div class="relative" onclick="showDroplist('status-droplist')" id="status-search">
                            <span
                                class="text-[13px] cursor-pointer absolute px-[5px] bg-white -top-[10px] left-[15px]">Trạng
                                thái</span>
                            <input type="text"
                                value="<?= isset($_GET['search-status']) ? $_GET['search-status'] : null ?>"
                                class="hidden" name="search-status">
                            <input type="text" readonly
                                value="<?= isset($_GET['search-status']) ? ($_GET['search-status'] == 1 ? "Đã duyệt" : ($_GET['search-status'] == 2 ? "Không duyệt" : ($_GET['search-status'] == 0 ? "Chờ duyệt" : "Tất cả"))) : 'Tất cả' ?>"
                                class="cursor-pointer px-2.5 pl-[20px] py-[8px] w-[280px] border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                            <svg class="absolute right-[0px] top-[11px]" width="15" height="15" viewBox="0 0 15 15"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2.76911 5.31995C2.93759 5.12339 3.23351 5.10063 3.43007 5.26911L7.50001 8.75763L11.57 5.26911C11.7665 5.10063 12.0624 5.12339 12.2309 5.31995C12.3994 5.51651 12.3766 5.81243 12.1801 5.98091L7.80507 9.73091C7.62953 9.88138 7.37049 9.88138 7.19495 9.73091L2.81995 5.98091C2.62339 5.81243 2.60063 5.51651 2.76911 5.31995Z"
                                    fill="#1C274C" />
                            </svg>
                            <div class="absolute flex flex-col bg-white py-2 rounded-[6px] border border-[#d8d8d8] text-[13px] hidden w-[280px]"
                                id="status-droplist">
                                <span class="hover:bg-gray-100 px-[20px] py-[3px] text-[#505050]"
                                    onclick="select('status-search', null, 'Tất cả')">Tất cả</span>
                                <span class="hover:bg-gray-100 px-[20px] py-[3px] text-[#505050]"
                                    onclick="select('status-search', 1, 'Đã duyệt')">Đã duyệt</span>
                                <span class="hover:bg-gray-100 px-[20px] py-[3px] text-[#505050]"
                                    onclick="select('status-search', 0, 'Chờ duyệt')">Chờ duyệt</span>
                                <span class="hover:bg-gray-100 px-[20px] py-[3px] text-[#505050]"
                                    onclick="select('status-search', 2, 'Không duyệt')">Không duyệt</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative w-[60%]">
                        <span class="text-[13px] absolute left-[15px] -top-[10px] bg-white px-1.5">Tên khách hàng</span>
                        <input type="text" name="search-prodName"
                            value="<?= isset($_GET['search-prodName']) ? $_GET['search-prodName'] : null ?>"
                            class="border-solid px-4 py-1.5 border-[#d8d8d8] border rounded-[6px] w-full focus-within:border-[#0071AF] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                    </div>
                    <button type="submit"
                        class="rounded-[6px] bg-[#0071AF] px-[16px] py-[7px] text-[13px] text-white mr-10">Tìm
                        kiếm</button>
                </div>
            </div>
            <div class="flex flex-col px-[50px] py-[25px]">
                <div class="flex justify-between items-center">
                    <span class="text-[#0071AF] font-[600]">DANH SÁCH KHÁCH HÀNG</span>
                </div>
                <div class="mt-[20px] text-[#505050]">
                    <div class="grid grid-cols-11 border-b pb-2">
                        <span class="text-[13px] font-[600]">STT</span>
                        <span class="text-[13px] font-[600]">Mã khách hàng</span>
                        <span class="text-[13px] col-span-2 font-[600]">Tên khách hàng</span>
                        <span class="text-[13px] font-[600]">Số điện thoại</span>
                        <span class="text-[13px] col-span-4 font-[600]">Địa chỉ</span>
                        <span class="text-[13px] font-[600]">Trạng thái</span>
                        <span class="text-[13px] font-[600]">Số GPP</span>
                    </div>
                    <?php
                    $i = ($page - 1) * $pageSize;
                    foreach (array_slice($customers, ($page - 1) * $pageSize, $pageSize) as $cus): ?>
                        <div class="grid grid-cols-11 py-[15px] border-b cursor-pointer"
                            onclick="window.location.href = 'http://localhost/PharmaDI-Admin/customer/customer-detail.php?cusId=<?= $cus['cusId'] ?>'">
                            <span class="text-[13px] truncate ">
                                <?= $i = $i + 1 ?>
                            </span>
                            <span class="text-[13px] truncate">
                                <?= $cus['cusId'] ?>
                            </span>
                            <span class="text-[13px] col-span-2 truncate max-w-[400px]">
                                <?= $cus['cusName'] ?>
                            </span>
                            <span class="text-[13px] truncate">
                                <?= $cus['cusPhone'] ?>
                            </span>
                            <span class="text-[13px] col-span-4 truncate">
                                <?= $cus['cusAddress'] ?>
                            </span>
                            <span class="text-[13px] overflow-x-hidden whitespace-nowrap w-[75px]">
                                <?= $cus['cusStatus'] == 1 ? "Đã duyệt" : "Chờ duyệt"?>
                            </span>
                            <span class="text-[13px] truncate max-w-[100px]">
                                <?= $cus['cusGPP'] ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                    <div class="flex items-center justify-end mt-[20px]">
                        <div class="flex">
                            <select class="border border-[#d8d8d8] text-[13px] px-1 rounded-[2px] outline-0 mr-[10px]"
                                onchange="this.form.submit()" name='pageSize'>
                                <option value="10" <?php if ($pageSize == 10)
                                    echo "selected" ?>>10</option>
                                    <option value="30" <?php if ($pageSize == 30)
                                    echo "selected" ?>>30</option>
                                    <option value="50" <?php if ($pageSize == 50)
                                    echo "selected" ?>>50</option>
                                </select>
                                <span class="text-[13px] text-[#505050]">Tổng số
                                <?= count($customers) ?> kết quả
                            </span>
                        </div>
                        <div class="flex items-center pl-[10px]">
                            <svg class="cursor-pointer" width="16" height="16" onclick="document.getElementById('page-product').value = <?= 1 ?>; submitForm('form-product-search')" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.6586 2.95364C11.8683 3.13335 11.8925 3.449 11.7128 3.65866L7.99174 7.99993L11.7128 12.3412C11.8925 12.5509 11.8683 12.8665 11.6586 13.0462C11.4489 13.2259 11.1333 13.2017 10.9536 12.992L6.95357 8.32533C6.79308 8.13808 6.79308 7.86178 6.95357 7.67454L10.9536 3.00787C11.1333 2.79821 11.4489 2.77393 11.6586 2.95364ZM8.99199 2.9537C9.20165 3.13342 9.22594 3.44907 9.04622 3.65873L5.32513 8L9.04622 12.3413C9.22594 12.5509 9.20165 12.8666 8.99199 13.0463C8.78233 13.226 8.46668 13.2017 8.28697 12.9921L4.28697 8.3254C4.12647 8.13815 4.12647 7.86185 4.28697 7.6746L8.28697 3.00794C8.46668 2.79827 8.78233 2.77399 8.99199 2.9537Z"
                                    fill="#505050" />
                            </svg>
                            <svg class="cursor-pointer" width="16" height="16" onclick="document.getElementById('page-product').value = <?= $page - 1 ?>; submitForm('form-product-search')" viewBox="0 0 16 16" fill="none" onclick="slide(false)"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.3254 2.95371C10.1157 2.77399 9.80007 2.79827 9.62036 3.00794L5.62036 7.6746C5.45987 7.86185 5.45987 8.13815 5.62036 8.3254L9.62036 12.9921C9.80007 13.2017 10.1157 13.226 10.3254 13.0463C10.535 12.8666 10.5593 12.5509 10.3796 12.3413L6.65853 8L10.3796 3.65873C10.5593 3.44907 10.535 3.13342 10.3254 2.95371Z"
                                    fill="#505050" />
                            </svg>
                            <div class="w-[100px] overflow-hidden relative h-[20px]">
                                <div class="flex cursor-pointer" id="container-slide" style="--transitionto:0px">
                                    <input type="text" class="hidden" name='page' id='page-product'
                                        value='<?= $page ?>'>
                                    <?php
                                    for ($i = 0; $i <= floor(count($customers) / $pageSize); $i++): ?>
                                        <span
                                            class="text-[13px] px-1 min-w-[20px] min-h-[20px] rounded-full flex justify-center items-center <?php if($page==$i+1) echo 'bg-[#d8d8d8]' ?>"
                                            onclick="document.getElementById('page-product').value = <?= $i + 1 ?>; submitForm('form-product-search')"><?= $i + 1 ?></span>
                                    <?php endfor ?>
                                </div>
                            </div>
                            <svg class="cursor-pointer" width="16" height="16" onclick="document.getElementById('page-product').value = <?= $page + 1 ?>; submitForm('form-product-search')" viewBox="0 0 16 16" fill="none" onclick="slide(true)"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.67461 2.95371C5.88428 2.77399 6.19993 2.79827 6.37964 3.00794L10.3796 7.6746C10.5401 7.86185 10.5401 8.13815 10.3796 8.3254L6.37964 12.9921C6.19993 13.2017 5.88428 13.226 5.67461 13.0463C5.46495 12.8666 5.44067 12.5509 5.62038 12.3413L9.34147 8L5.62038 3.65873C5.44067 3.44907 5.46495 3.13342 5.67461 2.95371Z"
                                    fill="#505050" />
                            </svg>
                            <svg class="cursor-pointer" width="16" height="16" onclick="document.getElementById('page-product').value = <?= floor(count($customers) / $pageSize) + 1 ?>; submitForm('form-product-search')" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.34115 2.95364C4.55081 2.77393 4.86646 2.79821 5.04617 3.00787L9.04617 7.67454C9.20667 7.86178 9.20667 8.13808 9.04617 8.32533L5.04617 12.992C4.86646 13.2017 4.55081 13.2259 4.34115 13.0462C4.13148 12.8665 4.1072 12.5509 4.28692 12.3412L8.008 7.99993L4.28692 3.65866C4.1072 3.449 4.13148 3.13335 4.34115 2.95364ZM7.00794 2.95371C7.21761 2.77399 7.53326 2.79828 7.71297 3.00794L11.713 7.6746C11.8735 7.86185 11.8735 8.13815 11.713 8.3254L7.71297 12.9921C7.53326 13.2017 7.21761 13.226 7.00794 13.0463C6.79828 12.8666 6.774 12.5509 6.95371 12.3413L10.6748 8L6.95371 3.65873C6.774 3.44907 6.79828 3.13342 7.00794 2.95371Z"
                                    fill="#505050" />
                            </svg>
                        </div>
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
    function changePageSize(value) {
        console.log(value)
    }
    function submitForm(id) {
        document.getElementById(id).submit()
    }
</script>
<?php
?>