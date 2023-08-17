<?php
require_once "product-pdo.php";
$product = new Product();
if (isset($_GET['search-prodName']) || isset($_GET['search-status']))
    $products = $product->getData($_GET['search-prodName'], $_GET['search-status']);
else {
    $products = $product->getData(null, null); 
}
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 10;
if (count($products) <= ($page - 1) * $pageSize) {
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
                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8.25 9.5C8.25 7.42893 9.92893 5.75 12 5.75C14.0711 5.75 15.75 7.42893 15.75 9.5C15.75 11.5711 14.0711 13.25 12 13.25C9.92893 13.25 8.25 11.5711 8.25 9.5ZM12 7.25C10.7574 7.25 9.75 8.25736 9.75 9.5C9.75 10.7426 10.7574 11.75 12 11.75C13.2426 11.75 14.25 10.7426 14.25 9.5C14.25 8.25736 13.2426 7.25 12 7.25Z"
                            fill="#505050" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.25 12.5C1.25 6.56294 6.06294 1.75 12 1.75C17.9371 1.75 22.75 6.56294 22.75 12.5C22.75 18.4371 17.9371 23.25 12 23.25C6.06294 23.25 1.25 18.4371 1.25 12.5ZM12 3.25C6.89137 3.25 2.75 7.39137 2.75 12.5C2.75 15.0456 3.77827 17.351 5.4421 19.0235C5.6225 18.0504 5.97694 17.1329 6.68837 16.3951C7.75252 15.2915 9.45416 14.75 12 14.75C14.5457 14.75 16.2474 15.2915 17.3115 16.3951C18.023 17.1329 18.3774 18.0505 18.5578 19.0236C20.2217 17.3511 21.25 15.0456 21.25 12.5C21.25 7.39137 17.1086 3.25 12 3.25ZM17.1937 20.1554C17.0918 18.9435 16.8286 18.0553 16.2318 17.4363C15.5823 16.7628 14.3789 16.25 12 16.25C9.62099 16.25 8.41761 16.7628 7.76815 17.4363C7.17127 18.0553 6.90811 18.9434 6.80622 20.1553C8.28684 21.1618 10.0747 21.75 12 21.75C13.9252 21.75 15.7131 21.1618 17.1937 20.1554Z"
                            fill="#505050" />
                    </svg>
                    <span style="padding: 0 5px; font-size: 14px">huyenmy</span>
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.3079 7.59327C16.5325 7.85535 16.5022 8.24991 16.2401 8.47455L10.4067 13.4745C10.1727 13.6752 9.82731 13.6752 9.59325 13.4745L3.75992 8.47455C3.49784 8.24991 3.46749 7.85534 3.69213 7.59327C3.91677 7.33119 4.31133 7.30084 4.57341 7.52548L10 12.1768L15.4266 7.52548C15.6887 7.30084 16.0832 7.33119 16.3079 7.59327Z"
                            fill="#505050" />
                    </svg>
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
                        <span class="text-[13px] absolute left-[15px] -top-[10px] bg-white px-1.5">Tên sản phẩm</span>
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
                    <span class="text-[#0071AF] font-[600]">DANH SÁCH SẢN PHẨM</span>
                    <button type="button"
                        onclick="window.location.href='http://localhost/PharmaDI-Admin/product/product-new.php'"
                        class="border-[#15A5E3] border border-solid px-[12px] py-[5px] text-[13px] rounded-[8px] text-[#0071AF]">Thêm
                        mới</button>
                </div>
                <div class="mt-[20px] text-[#505050]">
                    <div class="grid grid-cols-11 border-b pb-2">
                        <span class="text-[13px] font-[600]">STT</span>
                        <span class="text-[13px] font-[600]">Mã sản phẩm</span>
                        <span class="text-[13px] col-span-4 font-[600]">Tên sản phẩm</span>
                        <span class="text-[13px] font-[600]">Trạng thái</span>
                        <span class="text-[13px] font-[600]">Ngày tạo</span>
                        <span class="text-[13px] font-[600]">Ngày sửa</span>
                        <span class="text-[13px] font-[600]">Người tạo</span>
                        <span class="text-[13px] font-[600]">Người sửa</span>
                    </div>
                    <?php
                    $i = ($page - 1) * $pageSize;
                    foreach (array_slice($products, ($page - 1) * $pageSize, $pageSize) as $prod): ?>
                        <div class="grid grid-cols-11 py-[15px] border-b cursor-pointer"
                            onclick="window.location.href = 'http://localhost/PharmaDI-Admin/product/product-detail.php?prodId=<?= $prod['SKU'] ?>'">
                            <span class="text-[13px] truncate ">
                                <?= $i = $i + 1 ?>
                            </span>
                            <span class="text-[13px] truncate">
                                <?= $prod['SKU'] ?>
                            </span>
                            <span class="text-[13px] col-span-4 truncate max-w-[400px]">
                                <?= $prod['prodName'] ?>
                            </span>
                            <span class="text-[13px] truncate">
                                <?= $prod['prodStatus'] == 1 ? "Đã duyệt" : "Chờ duyệt" ?>
                            </span>
                            <span class="text-[13px] truncate">
                                <?= $prod['prodCreatedDate'] ?>
                            </span>
                            <span class="text-[13px] overflow-x-hidden whitespace-nowrap w-[75px]">
                                <?= $prod['prodLastUpdate'] ?>
                            </span>
                            <span class="text-[13px] truncate max-w-[100px]">
                                <?= $prod['prodCreatedUser'] ?>
                            </span>
                            <span class="text-[13px] truncate max-w-[100px]">
                                <?= $prod['prodLastUpdateUser'] ?>
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
                                <?= count($products) ?> kết quả
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
                                    for ($i = 0; $i <= floor(count($products) / $pageSize); $i++): ?>
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
                            <svg class="cursor-pointer" width="16" height="16" onclick="document.getElementById('page-product').value = <?= floor(count($products) / $pageSize) + 1 ?>; submitForm('form-product-search')" viewBox="0 0 16 16" fill="none"
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