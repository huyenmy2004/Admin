<?php
require_once "customer-pdo.php";
$customer = new Customer();
if (isset($_GET['name']) || isset($_GET['phone']))
    $customers = $customer->getData($_GET['name'], $_GET['phone']);
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
    <title>Khách hàng</title>
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
    <form method="get" id='form-product-search' class="flex justify-between">
        <div class="max-h min-h-vh">
            <?php require_once '../menu.php'; ?>
        </div>
        <div class="bg-white m-8 box w-full text-[#505050]">
            <!--Search-->
            <div class="flex mt-10 justify-between w-full">
                <div class="w-full ml-10 flex justify-between">
                    <div class="relative w-full pr-3">
                        <span class="text-[13px] absolute left-[15px] -top-[10px] bg-white px-1.5">Số điện thoại</span>
                        <input type="text" name="phone"
                            value="<?= isset($_GET['phone']) ? $_GET['phone'] : null ?>"
                            class="border-solid px-4 py-1.5 border-[#d8d8d8] border rounded-[6px] w-full focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                    </div>
                    <div class="relative mr-5 w-full">
                        <span class="text-[13px] absolute left-[15px] -top-[10px] bg-white px-1.5">Tên khách hàng</span>
                        <input type="text" name="name"
                            value="<?= isset($_GET['name']) ? $_GET['name'] : null ?>"
                            class="border-solid px-4 py-1.5 border-[#d8d8d8] border rounded-[6px] w-full focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                    </div>
                    <button type="submit"
                        class="rounded-[6px] bg-[#0091D0] px-[16px] py-[7px] text-[13px] text-white mr-10 min-w-max">Tìm
                        kiếm</button>
                </div>
            </div>
            <div class="flex flex-col px-[50px] py-[25px]">
                <div class="flex justify-between items-center">
                    <span class="text-[#0091D0] font-[600]">DANH SÁCH KHÁCH HÀNG</span>
                </div>
                <div class="mt-[20px] text-[#505050]">
                    <div class="grid grid-cols-11 border-b pb-2">
                        <span class="text-[13px] font-[600]">STT</span>
                        <span class="text-[13px] font-[600]">ID</span>
                        <span class="text-[13px] col-span-2 font-[600]">Tên khách hàng</span>
                        <span class="text-[13px] col-span-2 font-[600]">Tên liên hệ</span>
                        <span class="text-[13px] font-[600]">Số điện thoại</span>
                        <span class="text-[13px] col-span-3 font-[600]">Địa chỉ</span>
                        <span class="text-[13px] font-[600]">Số GPP</span>
                    </div>
                    <?php
                    $i = ($page - 1) * $pageSize;
                    foreach (array_slice($customers, ($page - 1) * $pageSize, $pageSize) as $cus): ?>
                        <div class="grid grid-cols-11 py-3 border-b cursor-pointer"
                            onclick="window.location.href = 'http://localhost/PharmaDI-Admin/customer/customer-detail.php?cusId=<?= $cus['cusId'] ?>'">
                            <span class="text-[13px] truncate ">
                                <?= $i = $i + 1 ?>
                            </span>
                            <span class="text-[13px] truncate">
                                <?= $cus['cusId'] ?>
                            </span>
                            <span class="text-[13px] col-span-2 truncate">
                                <?= $cus['cusName'] ?>
                            </span>
                            <span class="text-[13px] col-span-2 truncate">
                                <?= $cus['cusContact'] ?>
                            </span>
                            <span class="text-[13px] truncate">
                                <?= $cus['cusPhone'] ?>
                            </span>
                            <span class="text-[13px] col-span-3 truncate">
                                <?= $cus['cusAddress'] ?>
                            </span>
                            <span class="text-[13px] truncate max-w-[100px]">
                                <?= $cus['cusGPP'] ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                    <div class="flex items-center justify-end mt-6">
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
                            <svg class="cursor-pointer" width="16" height="16"
                                onclick="document.getElementById('page-product').value = <?= 1 ?>; submitForm('form-product-search')"
                                viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.6586 2.95364C11.8683 3.13335 11.8925 3.449 11.7128 3.65866L7.99174 7.99993L11.7128 12.3412C11.8925 12.5509 11.8683 12.8665 11.6586 13.0462C11.4489 13.2259 11.1333 13.2017 10.9536 12.992L6.95357 8.32533C6.79308 8.13808 6.79308 7.86178 6.95357 7.67454L10.9536 3.00787C11.1333 2.79821 11.4489 2.77393 11.6586 2.95364ZM8.99199 2.9537C9.20165 3.13342 9.22594 3.44907 9.04622 3.65873L5.32513 8L9.04622 12.3413C9.22594 12.5509 9.20165 12.8666 8.99199 13.0463C8.78233 13.226 8.46668 13.2017 8.28697 12.9921L4.28697 8.3254C4.12647 8.13815 4.12647 7.86185 4.28697 7.6746L8.28697 3.00794C8.46668 2.79827 8.78233 2.77399 8.99199 2.9537Z"
                                    fill="#505050" />
                            </svg>
                            <svg class="cursor-pointer" width="16" height="16"
                                onclick="document.getElementById('page-product').value = <?= $page - 1 ?>; submitForm('form-product-search')"
                                viewBox="0 0 16 16" fill="none" onclick="slide(false)"
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
                                            class="text-[13px] px-1 min-w-[20px] min-h-[20px] rounded-full flex justify-center items-center <?php if ($page == $i + 1)
                                                echo 'bg-[#d8d8d8]' ?>"
                                                onclick="document.getElementById('page-product').value = <?= $i + 1 ?>; submitForm('form-product-search')">
                                            <?= $i + 1 ?>
                                        </span>
                                    <?php endfor ?>
                                </div>
                            </div>
                            <svg class="cursor-pointer" width="16" height="16"
                                onclick="document.getElementById('page-product').value = <?= $page + 1 ?>; submitForm('form-product-search')"
                                viewBox="0 0 16 16" fill="none" onclick="slide(true)"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.67461 2.95371C5.88428 2.77399 6.19993 2.79827 6.37964 3.00794L10.3796 7.6746C10.5401 7.86185 10.5401 8.13815 10.3796 8.3254L6.37964 12.9921C6.19993 13.2017 5.88428 13.226 5.67461 13.0463C5.46495 12.8666 5.44067 12.5509 5.62038 12.3413L9.34147 8L5.62038 3.65873C5.44067 3.44907 5.46495 3.13342 5.67461 2.95371Z"
                                    fill="#505050" />
                            </svg>
                            <svg class="cursor-pointer" width="16" height="16"
                                onclick="document.getElementById('page-product').value = <?= floor(count($customers) / $pageSize) + 1 ?>; submitForm('form-product-search')"
                                viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
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