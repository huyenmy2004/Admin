<?php
require_once "account-pdo.php";
$account = new Account();
if (isset($_GET['search-cusName']))
    $accounts = $account->getData($_GET['search-cusName']);
else {
    $accounts = $account->getData(null);
}
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 10;
if (count($accounts) <= ($page - 1) * $pageSize) {
    $page = 1;
}
?>

<head>
    <meta charset="UTF-8">
    <title>Tài khoản</title>
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

    .account-list {
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
    <form method="GET" id='form-account-search' class="flex justify-between">
        <div class="max-h min-h-vh">
            <?php require_once '../menu.php'; ?>
        </div>
        <div class="bg-white m-8 box w-full">
            <!--Search-->
            <div class="flex mt-10 justify-between w-full">
                <div class="w-full mx-3 flex justify-between">
                    <div class="relative mx-6 w-full">
                        <span class="text-[13px] absolute left-[15px] -top-[10px] bg-white px-1.5">Tên người dùng</span>
                        <input type="text" name="search-cusName"
                            value="<?= isset($_GET['search-cusName']) ? $_GET['search-cusName'] : null ?>"
                            class="border-solid px-4 py-1.5 border-[#d8d8d8] border rounded-[6px] w-full focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                    </div>
                    <button type="submit"
                        class="rounded-[6px] bg-[#0091D0] px-[16px] py-[7px] text-[13px] text-white mr-6 min-w-max">Tìm
                        kiếm</button>
                </div>
            </div>
            <div class="flex flex-col px-[50px] py-[25px]">
                <div class="flex justify-between items-center">
                    <span class="text-[#0091D0] font-[600]">DANH SÁCH TÀI KHOẢN</span>
                    <!-- <button type="button"
                        onclick="window.location.href='http://localhost/PharmaDI-Admin/account/account-create.php'"
                        class="border-[#15A5E3] border border-solid px-[12px] py-[5px] text-[13px] rounded-[8px] text-[#0091D0]">Thêm
                        mới</button> -->
                </div>
                <div class="mt-[20px] text-[#505050]">
                    <div class="grid grid-cols-12 border-b pb-2">
                        <span class="text-[13px] font-[600]">STT</span>
                        <span class="text-[13px] col-span-4 font-[600]">Tên người dùng</span>
                        <span class="text-[13px] col-span-2">Tên tài khoản</span>
                        <span class="text-[13px] col-span-2">Số điện thoại</span>
                        <span class="text-[13px] col-span-2">Phân quyền</span>
                        <span class="text-[13px] font-[600]">Thao tác</span>
                    </div>
                    <?php
                    $i = ($page - 1) * $pageSize;
                    foreach (array_slice($accounts, ($page - 1) * $pageSize, $pageSize) as $account): ?>
                        <div class="grid grid-cols-12 py-3 border-b cursor-pointer">
                            <span class="text-[13px] truncate ">
                                <?= $i = $i + 1 ?>
                            </span>
                            <span class="text-[13px] col-span-2 truncate col-span-4 max-w-[400px]">
                                <?= isset($account['cusName']) ? $account['cusName'] : "Tài khoản hệ thống" ?>
                            </span>
                            <span class="text-[13px] truncate col-span-2">
                                <?= $account['username'] ?>
                            </span>
                            <span class="text-[13px] truncate col-span-2">
                                <?= $account['cusPhone'] ?>
                            </span>
                            <span class="text-[13px] overflow-x-hidden col-span-2 whitespace-nowrap w-[75px]">
                                <?= $account['role'] == 1 ? 'Admin' : "User" ?>
                            </span>
                            <span class="text-[13px] overflow-x-hidden whitespace-nowrap w-[75px] pl-2.5" onclick="window.location.href='http://localhost/PharmaDI-Admin/account/action-delete.php?username=<?=$account['username']?>&cusId=<?=$account['cusId']?>'">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.2309 4.04162C8.4886 3.31253 9.18396 2.79167 9.99937 2.79167C10.8148 2.79167 11.5101 3.31253 11.7678 4.04162C11.8829 4.36706 12.24 4.53764 12.5654 4.42261C12.8908 4.30758 13.0614 3.95051 12.9464 3.62506C12.5177 2.41216 11.361 1.54167 9.99937 1.54167C8.63775 1.54167 7.48105 2.41216 7.05235 3.62506C6.93733 3.95051 7.1079 4.30758 7.43335 4.42261C7.7588 4.53764 8.11588 4.36706 8.2309 4.04162Z"
                                        fill="#505050" />
                                    <path
                                        d="M2.29102 5.50001C2.29102 5.15483 2.57084 4.87501 2.91602 4.87501H17.0828C17.4279 4.87501 17.7078 5.15483 17.7078 5.50001C17.7078 5.84518 17.4279 6.12501 17.0828 6.12501H2.91602C2.57084 6.12501 2.29102 5.84518 2.29102 5.50001Z"
                                        fill="#505050" />
                                    <path
                                        d="M4.2634 6.95972C4.60781 6.93676 4.90563 7.19735 4.92859 7.54176L5.31187 13.291C5.38675 14.4142 5.44011 15.1958 5.55725 15.7838C5.67087 16.3541 5.82948 16.6561 6.05733 16.8692C6.28517 17.0824 6.59697 17.2206 7.17364 17.296C7.76814 17.3738 8.55148 17.375 9.67718 17.375H10.3216C11.4474 17.375 12.2307 17.3738 12.8252 17.296C13.4019 17.2206 13.7137 17.0824 13.9415 16.8692C14.1693 16.6561 14.328 16.3541 14.4416 15.7838C14.5587 15.1958 14.6121 14.4142 14.687 13.291L15.0702 7.54176C15.0932 7.19735 15.391 6.93676 15.7354 6.95972C16.0798 6.98268 16.3404 7.2805 16.3175 7.62491L15.9313 13.418C15.86 14.487 15.8025 15.3504 15.6675 16.028C15.5272 16.7324 15.2885 17.3208 14.7955 17.782C14.3025 18.2432 13.6995 18.4423 12.9873 18.5354C12.3023 18.625 11.4369 18.625 10.3656 18.625H9.63323C8.56191 18.625 7.69654 18.625 7.01151 18.5354C6.2993 18.4423 5.69634 18.2432 5.20335 17.782C4.71035 17.3208 4.47167 16.7324 4.33134 16.028C4.19636 15.3504 4.13881 14.487 4.06756 13.418L3.68135 7.62491C3.65839 7.2805 3.91898 6.98268 4.2634 6.95972Z"
                                        fill="#505050" />
                                </svg>

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
                                <?= count($accounts) ?> kết quả
                            </span>
                        </div>
                        <div class="flex items-center pl-[10px]">
                            <svg class="cursor-pointer" width="16" height="16"
                                onclick="document.getElementById('page-account').value = <?= 1 ?>; submitForm('form-account-search')"
                                viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.6586 2.95364C11.8683 3.13335 11.8925 3.449 11.7128 3.65866L7.99174 7.99993L11.7128 12.3412C11.8925 12.5509 11.8683 12.8665 11.6586 13.0462C11.4489 13.2259 11.1333 13.2017 10.9536 12.992L6.95357 8.32533C6.79308 8.13808 6.79308 7.86178 6.95357 7.67454L10.9536 3.00787C11.1333 2.79821 11.4489 2.77393 11.6586 2.95364ZM8.99199 2.9537C9.20165 3.13342 9.22594 3.44907 9.04622 3.65873L5.32513 8L9.04622 12.3413C9.22594 12.5509 9.20165 12.8666 8.99199 13.0463C8.78233 13.226 8.46668 13.2017 8.28697 12.9921L4.28697 8.3254C4.12647 8.13815 4.12647 7.86185 4.28697 7.6746L8.28697 3.00794C8.46668 2.79827 8.78233 2.77399 8.99199 2.9537Z"
                                    fill="#505050" />
                            </svg>
                            <svg class="cursor-pointer" width="16" height="16"
                                onclick="document.getElementById('page-account').value = <?= $page - 1 ?>; submitForm('form-account-search')"
                                viewBox="0 0 16 16" fill="none" onclick="slide(false)"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.3254 2.95371C10.1157 2.77399 9.80007 2.79827 9.62036 3.00794L5.62036 7.6746C5.45987 7.86185 5.45987 8.13815 5.62036 8.3254L9.62036 12.9921C9.80007 13.2017 10.1157 13.226 10.3254 13.0463C10.535 12.8666 10.5593 12.5509 10.3796 12.3413L6.65853 8L10.3796 3.65873C10.5593 3.44907 10.535 3.13342 10.3254 2.95371Z"
                                    fill="#505050" />
                            </svg>
                            <div class="w-[100px] overflow-hidden relative h-[20px]">
                                <div class="flex cursor-pointer" id="container-slide" style="--transitionto:0px">
                                    <input type="text" class="hidden" name='page' id='page-account'
                                        value='<?= $page ?>'>
                                    <?php
                                    for ($i = 0; $i <= floor(count($accounts) / $pageSize); $i++): ?>
                                        <span class="text-[13px] px-1 min-w-[20px] min-h-[20px] rounded-full flex justify-center items-center <?php if ($page == $i + 1)
                                            echo 'bg-[#d8d8d8]' ?>"
                                                onclick="document.getElementById('page-account').value = <?= $i + 1 ?>; submitForm('form-account-search')">
                                            <?= $i + 1 ?>
                                        </span>
                                    <?php endfor ?>
                                </div>
                            </div>
                            <svg class="cursor-pointer" width="16" height="16"
                                onclick="document.getElementById('page-account').value = <?= $page + 1 ?>; submitForm('form-account-search')"
                                viewBox="0 0 16 16" fill="none" onclick="slide(true)"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.67461 2.95371C5.88428 2.77399 6.19993 2.79827 6.37964 3.00794L10.3796 7.6746C10.5401 7.86185 10.5401 8.13815 10.3796 8.3254L6.37964 12.9921C6.19993 13.2017 5.88428 13.226 5.67461 13.0463C5.46495 12.8666 5.44067 12.5509 5.62038 12.3413L9.34147 8L5.62038 3.65873C5.44067 3.44907 5.46495 3.13342 5.67461 2.95371Z"
                                    fill="#505050" />
                            </svg>
                            <svg class="cursor-pointer" width="16" height="16"
                                onclick="document.getElementById('page-account').value = <?= floor(count($accounts) / $pageSize) + 1 ?>; submitForm('form-account-search')"
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