<!DOCTYPE html>
<html lang="en">
<?php
require_once "product-pdo.php";
$brand = new Brand();
$brands = $brand->getData();
$tag = new Tag();
$tags = $tag->getData();
$cate = new Category();
$cates = $cate->getData();
$listImg = [];

// $countries = json_decode(file_get_contents('https://restcountries.com/v3.1/all'));

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../asset/image/logo-shortcut.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Chi tiết sản phẩm</title>
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
    </style>
</head>

<body>
    <div class="bg-[#505050] bg-opacity-[40%] h-[100vh] w-[100vw] fixed z-10 flex flex-col justify-center items-center hidden"
        id="popupCf">
        <div class="bg-white absolute p-[40px] flex flex-col justify-center rounded-[8px]">
            <span class="text-[#0091D0] text-[18px] font-[600] mb-2 flex justify-center">XOÁ ĐƠN HÀNG ĐÃ CHỌN?</span>
            <span class="text-[#505050] text-[13px] mb-4 flex justify-center">Bạn chắc chắn muốn xoá đơn hàng đã
                chọn?</span>
            <div class="flex w-full justify-center">
                <button
                    class="bg-white border border-solid text-[13px] border-[#d8d8d8] rounded-[8px] mr-4 py-[8px] px-[12px] "
                    onclick="document.getElementById('popupCf').classList.toggle('hidden')">Huỷ bỏ</button>
                <button
                    class="bg-[#0091D0] text-white border border-solid text-[13px] border-[#d8d8d8] rounded-[8px] py-[8px] px-[12px]"
                    onclick="window.location.href='http://localhost/PharmaDI-Admin/product/action-delete.php?prodId=<?= $prod['SKU'] ?>'">Xác
                    nhận</button>
            </div>
        </div>
    </div>
    <div class="flex w-full justify-between w-full">
        <div class="max-h min-h-vh">
            <?php require_once '../menu.php'; ?>
        </div>
        <div class="flex w-full p-8 w-full">
            <form class="bg-white box w-full" method="POST" action="action-edit.php">
                <div class="flex justify-between w-full mt-2 px-[50px] py-[25px] flex-col text-[#505050]">
                    <!-- Breadscumb -->
                    <div class="flex items-center text-[14px]">
                        <span class="px-1 cursor-pointer"
                            onclick="window.location.href='http://localhost/PharmaDI-Admin/product/product-list.php'">Danh
                            sách sản phẩm</span>
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M1.09327 0.692102C1.35535 0.467463 1.74991 0.497814 1.97455 0.759893L6.97455 6.59323C7.17517 6.82728 7.17517 7.17266 6.97455 7.40672L1.97455 13.24C1.74991 13.5021 1.35535 13.5325 1.09327 13.3078C0.831188 13.0832 0.800837 12.6886 1.02548 12.4266L5.67684 6.99997L1.02548 1.57338C0.800837 1.3113 0.831188 0.916741 1.09327 0.692102Z"
                                fill="#505050" />
                        </svg>
                        <span class="px-1 cursor-pointer"
                            onclick="window.location.href='http://localhost/PharmaDI-Admin/product/product-detail.php?prodId=<?= $prod['SKU'] ?>'">Chi
                            tiết sản phẩm</span>
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M1.09327 0.692102C1.35535 0.467463 1.74991 0.497814 1.97455 0.759893L6.97455 6.59323C7.17517 6.82728 7.17517 7.17266 6.97455 7.40672L1.97455 13.24C1.74991 13.5021 1.35535 13.5325 1.09327 13.3078C0.831188 13.0832 0.800837 12.6886 1.02548 12.4266L5.67684 6.99997L1.02548 1.57338C0.800837 1.3113 0.831188 0.916741 1.09327 0.692102Z"
                                fill="#0091D0" />
                        </svg>
                        <span class="text-[#0091D0] px-1 font-[600]"> Chỉnh sửa sản phẩm</span>
                    </div>
                    <!-- Title -->
                    <div class="flex justify-between items-center py-[25px]">
                        <span class="text-[#0091D0] font-[600]">CHỈNH SỬA SẢN PHẨM</span>
                        <button type="button" onclick="document.getElementById('popupCf').classList.toggle('hidden')"
                            class="border-[#15A5E3] border border-solid px-[12px] py-[5px] text-[13px] rounded-[8px] text-[#0091D0]">Xoá
                            sản phẩm</button>
                    </div>
                    <!-- Textbox -->
                    <div class="flex w-full justify-between mt-1">
                        <div class=" mr-3 w-full">
                            <span class="text-[13px]  px-1 pb-1 font-[600]">Mã sản
                                phẩm</span>
                            <input type="text" name="prodId"
                                class="px-2.5 w-full pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px]">
                        </div>
                        <div class="relative mr-3 w-full" onclick="showDroplist('status-droplist')" id='status-prod'>
                            <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Trạng
                                thái</span>
                            <input type="text" class="hidden" name="prodStatus" readonly>
                            <input type="text" value="Chờ duyệt" readonly
                                class="cursor-pointer px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px]">
                            <svg class="absolute right-[10px] top-[40px]" width="15" height="15" viewBox="0 0 15 15"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2.76911 5.31995C2.93759 5.12339 3.23351 5.10063 3.43007 5.26911L7.50001 8.75763L11.57 5.26911C11.7665 5.10063 12.0624 5.12339 12.2309 5.31995C12.3994 5.51651 12.3766 5.81243 12.1801 5.98091L7.80507 9.73091C7.62953 9.88138 7.37049 9.88138 7.19495 9.73091L2.81995 5.98091C2.62339 5.81243 2.60063 5.51651 2.76911 5.31995Z"
                                    fill="#1C274C" />
                            </svg>
                        </div>
                        <div class="relative mr-3 w-full" onclick="showDroplist('cate-droplist')" id='product-cate'>
                            <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Danh mục</span>
                            <input type="text" value="" class="hidden" name="prodCateId">
                            <input type="text"
                                class="cursor-pointer px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]"
                                readonly>
                            <svg class="absolute right-[10px] top-[40px]" width="15" height="15" viewBox="0 0 15 15"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2.76911 5.31995C2.93759 5.12339 3.23351 5.10063 3.43007 5.26911L7.50001 8.75763L11.57 5.26911C11.7665 5.10063 12.0624 5.12339 12.2309 5.31995C12.3994 5.51651 12.3766 5.81243 12.1801 5.98091L7.80507 9.73091C7.62953 9.88138 7.37049 9.88138 7.19495 9.73091L2.81995 5.98091C2.62339 5.81243 2.60063 5.51651 2.76911 5.31995Z"
                                    fill="#1C274C" />
                            </svg>
                            <div class="absolute flex flex-col bg-white z-10 w-full py-1 rounded-[6px] border border-[#d8d8d8] text-[13px] hidden max-h-[200px] overflow-y-scroll"
                                id="cate-droplist">
                                <?php foreach ($cates as $cate): ?>
                                    <span class="hover:bg-gray-100 px-[20px] py-[2px] text-[#505050]"
                                        onclick="select('product-cate', '<?= $cate['cateId'] ?>', '<?= $cate['cateName'] ?>')">
                                        <?= $cate['cateName'] ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="relative w-full" onclick="showDroplist('tag-droplist')" id='product-tag'>
                            <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Tag</span>
                            <input type="text" value="" class="hidden" name="prodTagId">
                            <input type="text" readonly
                                class="px-2.5 cursor-pointer pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                            <svg class="absolute right-[10px] top-[40px]" width="15" height="15" viewBox="0 0 15 15"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2.76911 5.31995C2.93759 5.12339 3.23351 5.10063 3.43007 5.26911L7.50001 8.75763L11.57 5.26911C11.7665 5.10063 12.0624 5.12339 12.2309 5.31995C12.3994 5.51651 12.3766 5.81243 12.1801 5.98091L7.80507 9.73091C7.62953 9.88138 7.37049 9.88138 7.19495 9.73091L2.81995 5.98091C2.62339 5.81243 2.60063 5.51651 2.76911 5.31995Z"
                                    fill="#1C274C" />
                            </svg>
                            <div class="absolute flex flex-col bg-white z-10 w-full py-1 rounded-[6px] border border-[#d8d8d8] text-[13px] hidden max-h-[200px] overflow-y-scroll"
                                id="tag-droplist">
                                <?php foreach ($tags as $tag): ?>
                                    <span class="hover:bg-gray-100 px-[20px] py-[2px] text-[#505050]"
                                        onclick="select('product-tag', '<?= $tag['tagId'] ?>', '<?= $tag['tagName'] ?>')">
                                        <?= $tag['tagName'] ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class=" flex justify-between mt-2 w-full flex-col">
                        <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Tên sản phẩm</span>
                        <input type="text" name="prodName"
                            class="px-2.5 w-full pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                    </div>
                    <div class="flex w-full justify-between mt-2">
                        <div class="relative mr-3 w-full" onclick="showDroplist('brand-droplist')" id="product-brand">
                            <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Thương
                                hiệu</span>
                            <input type="text" class="hidden" name="prodBrandId">
                            <input type="text" value="<?php
                            foreach ($brands as $brand)
                                if ($prod['brandId'] == $brand['brandId'])
                                    echo $brand['brandName'];
                            ?>"
                                class="cursor-pointer px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                            <svg class="absolute right-[10px] top-[40px]" width="15" height="15" viewBox="0 0 15 15"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2.76911 5.31995C2.93759 5.12339 3.23351 5.10063 3.43007 5.26911L7.50001 8.75763L11.57 5.26911C11.7665 5.10063 12.0624 5.12339 12.2309 5.31995C12.3994 5.51651 12.3766 5.81243 12.1801 5.98091L7.80507 9.73091C7.62953 9.88138 7.37049 9.88138 7.19495 9.73091L2.81995 5.98091C2.62339 5.81243 2.60063 5.51651 2.76911 5.31995Z"
                                    fill="#1C274C" />
                            </svg>
                            <div class="absolute flex flex-col bg-white z-10 w-full py-1 rounded-[6px] border border-[#d8d8d8] text-[13px] hidden max-h-[200px] overflow-y-scroll"
                                id="brand-droplist">
                                <?php foreach ($brands as $brand): ?>
                                    <span class="hover:bg-gray-100 px-[20px] py-[2px] text-[#505050]"
                                        onclick="select('product-brand', '<?= $brand['brandId'] ?>', '<?= $brand['brandName'] ?>')">
                                        <?= $brand['brandName'] ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="relative mr-3 w-full" onclick="showDroplist('country-droplist')"
                            id='product-country'>
                            <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Quốc gia</span>
                            <input type="text" name="prodCountry"
                                class="px-2.5 w-full cursor-pointer pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                            <svg class="absolute right-[10px] top-[40px]" width="15" height="15" viewBox="0 0 15 15"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2.76911 5.31995C2.93759 5.12339 3.23351 5.10063 3.43007 5.26911L7.50001 8.75763L11.57 5.26911C11.7665 5.10063 12.0624 5.12339 12.2309 5.31995C12.3994 5.51651 12.3766 5.81243 12.1801 5.98091L7.80507 9.73091C7.62953 9.88138 7.37049 9.88138 7.19495 9.73091L2.81995 5.98091C2.62339 5.81243 2.60063 5.51651 2.76911 5.31995Z"
                                    fill="#1C274C" />
                            </svg>
                            <div class="absolute flex flex-col bg-white z-10 w-full py-1 rounded-[6px] border border-[#d8d8d8] text-[13px] hidden max-h-[200px] overflow-y-scroll"
                                id="country-droplist">
                                <?php foreach ($countries as $country): ?>
                                    <span class="hover:bg-gray-100 px-[20px] py-[2px] text-[#505050]"
                                        onclick="select('product-country', '<?= $country->{'name'}->{'common'} ?>' )">
                                        <?= $country->{'name'}->{'common'} ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>

                        </div>
                        <div class=" mr-3 w-full">
                            <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Đơn vị</span>
                            <input type="text" name="prodUnit"
                                class="px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                        </div>
                        <div class=" w-full">
                            <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Đã bán</span>
                            <input type="text" name="prodSellNumber"
                                class="px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px]">
                        </div>
                    </div>
                    <div class="flex w-full items-center justify-between">
                        <div class=" flex mt-2 w-full mr-3 flex-col">
                            <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Giá gốc</span>
                            <input type="text" name="prodPrice"
                                class="px-2.5 w-full pl-[20px] py-[8px] border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                        </div>
                        <div class=" flex mt-2 w-full flex-col">
                            <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Giá khuyến
                                mãi</span>
                            <input type="text" name="prodPriceSale"
                                class="px-2.5 w-full pl-[20px] py-[8px] border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                        </div>
                    </div>
                    <div class=" flex justify-between mt-2 w-full flex-col">
                        <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Thành phần</span>
                        <textarea name="prodIngredient" id=""
                            class="h-max min-h-[60px] px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px] resize-none"></textarea>
                    </div>
                    <div class=" flex justify-between mt-2 w-full flex-col">
                        <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Dạng bào chế</span>
                        <textarea name="prodDosageForms" id=""
                            class="h-max min-h-[60px] px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px] resize-none"></textarea>
                    </div>
                    <div class=" flex justify-between mt-2 w-full flex-col">
                        <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Liều dùng</span>
                        <textarea name="prodDosage" id=""
                            class="h-max min-h-[60px] px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px] resize-none"></textarea>
                    </div>
                    <div class=" flex justify-between mt-2 w-full flex-col">
                        <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Mô tả sản
                            phẩm</span>
                        <textarea name="prodDescript" id=""
                            class="h-max min-h-[100px] px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px] resize-none"></textarea>
                    </div>
                    <!-- Upload picture -->
                    <div class="flex w-full justify-start">
                        <div class="flex w-full justify-start">
                            <div onclick="getImage()" id="img"
                                class="w-[150px] mr-5 h-[120px] border border-dashed border-[#d8d8d8] rounded-[8px] mt-2 flex flex-col justify-center items-center cursor-pointer">
                                <input type="file" id="image" style="display: none;" #inputUpload
                                    onchange="getImageInfo()" multiple>
                                <input type="hidden" name="prodImg" id="prodImg">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.5535 2.49392C12.4114 2.33852 12.2106 2.25 12 2.25C11.7894 2.25 11.5886 2.33852 11.4465 2.49392L7.44648 6.86892C7.16698 7.17462 7.18822 7.64902 7.49392 7.92852C7.79963 8.20802 8.27402 8.18678 8.55352 7.88108L11.25 4.9318V16C11.25 16.4142 11.5858 16.75 12 16.75C12.4142 16.75 12.75 16.4142 12.75 16V4.9318L15.4465 7.88108C15.726 8.18678 16.2004 8.20802 16.5061 7.92852C16.8118 7.64902 16.833 7.17462 16.5535 6.86892L12.5535 2.49392Z"
                                        fill="#505050" />
                                    <path
                                        d="M3.75 15C3.75 14.5858 3.41422 14.25 3 14.25C2.58579 14.25 2.25 14.5858 2.25 15V15.0549C2.24998 16.4225 2.24996 17.5248 2.36652 18.3918C2.48754 19.2919 2.74643 20.0497 3.34835 20.6516C3.95027 21.2536 4.70814 21.5125 5.60825 21.6335C6.47522 21.75 7.57754 21.75 8.94513 21.75H15.0549C16.4225 21.75 17.5248 21.75 18.3918 21.6335C19.2919 21.5125 20.0497 21.2536 20.6517 20.6516C21.2536 20.0497 21.5125 19.2919 21.6335 18.3918C21.75 17.5248 21.75 16.4225 21.75 15.0549V15C21.75 14.5858 21.4142 14.25 21 14.25C20.5858 14.25 20.25 14.5858 20.25 15C20.25 16.4354 20.2484 17.4365 20.1469 18.1919C20.0482 18.9257 19.8678 19.3142 19.591 19.591C19.3142 19.8678 18.9257 20.0482 18.1919 20.1469C17.4365 20.2484 16.4354 20.25 15 20.25H9C7.56459 20.25 6.56347 20.2484 5.80812 20.1469C5.07435 20.0482 4.68577 19.8678 4.40901 19.591C4.13225 19.3142 3.9518 18.9257 3.85315 18.1919C3.75159 17.4365 3.75 16.4354 3.75 15Z"
                                        fill="#505050" />
                                </svg>
                                <span class="text-[13px]">Tải ảnh</span>
                            </div>
                            <div id='imgContainer' class="flex mr-5 h-[120px] mt-2 justify-center items-center ">
                                <input type="hidden" name="prodDeleteImg" id="prodDeleteImg">
                                <?php foreach ($prodImg as $index => $img): ?>
                                    <div class="flex h-full cursor-pointer " id="<?= $index . "prodImg" ?>">
                                        <img src="<?= $img['imgPath']; ?>" alt=""
                                            class="max-h-full mr-[20px] object-cover rounded-[8px] p-[8px]">
                                        <svg onclick="deleteImg('<?= $img['imgPath']; ?>', '<?= $index . "prodImg" ?>')"
                                            class="absolute top-3 right-7" width="15" height="15" viewBox="0 0 15 15"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="15" height="15" rx="7.5" fill="white" />
                                            <path
                                                d="M10.0412 5.62174C10.2242 5.43868 10.2242 5.14189 10.0412 4.95883C9.8581 4.77577 9.5613 4.77577 9.37824 4.95883L7.49999 6.83708L5.62175 4.95883C5.43869 4.77577 5.14189 4.77577 4.95883 4.95883C4.77577 5.14189 4.77577 5.43868 4.95883 5.62174L6.83708 7.49999L4.95883 9.37824C4.77577 9.5613 4.77577 9.8581 4.95883 10.0412C5.14189 10.2242 5.43868 10.2242 5.62174 10.0412L7.49999 8.1629L9.37825 10.0412C9.56131 10.2242 9.8581 10.2242 10.0412 10.0412C10.2242 9.8581 10.2242 9.5613 10.0412 9.37824L8.16291 7.49999L10.0412 5.62174Z"
                                                fill="#FF0000" />
                                        </svg>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="justify-end flex mt-2">
                        <button type="button"
                            onclick="window.location.href = 'http://localhost/PharmaDI-Admin/product/product-detail.php?prodId=<?= $prod['SKU'] ?>'"
                            class="text-[12px] border border-[#d8d8d8]  rounded-[6px] px-[14px] py-[7px] mr-3 text-[#505050]">Huỷ
                            bỏ</button>
                        <button type="submit"
                            class="text-[12px] bg-[#15A5E3] text-white rounded-[6px] px-[14px] py-[7px]">Chỉnh
                            sửa</button>
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
    }

    function select(id, value, label) {
        var dom = document.getElementById(id);
        dom.getElementsByTagName('input')[0].value = value;
        dom.getElementsByTagName('input')[1].value = label;
    }


    function getImage() {
        file.click();
    }

    list = []
    listDeleteImg = []

    function deleteImg(imgPath, index) {
        listDeleteImg.push(imgPath);
        document.getElementById('prodDeleteImg').value = JSON.stringify({ delete: listDeleteImg })
        document.getElementById(index).remove()
    }

    var file = document.getElementById('image');
    function getImageInfo() {
        for (let i = 0; i < (file.files.length <= 4 ? file.files.length : 4); i++) {
            let fileReader = new FileReader();
            fileReader.readAsDataURL(file.files[i])
            fileReader.onload = (e) => {
                var img = document.createElement('img');
                img.src = e.target.result
                list.push(e.target.result)
                document.getElementById('prodImg').value = JSON.stringify({ a: list })
                console.log(JSON.stringify({ a: list }))
                img.style.objectFit = 'cover'
                img.style.maxHeight = '100%'
                img.style.marginRight = '20px'
                document.getElementById('imgContainer').appendChild(img)
            }
        }
    }
</script>