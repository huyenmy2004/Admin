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

$countries = json_decode(file_get_contents('https://restcountries.com/v3.1/all'));
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../asset/image/logo-shortcut.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Thêm mới sản phẩm</title>
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
<div class="flex w-full justify-between w-full">
        <div class="max-h min-h-vh">
            <?php require_once '../menu.php'; ?>
        </div>
        <div class="flex w-full p-8 w-full">
        <form class="bg-white box w-full" method="POST" action="action-create.php">
        
            <!-- Content -->
            <div class="flex flex-col px-[40px] py-[20px] text-[#505050]">
                <!-- Breadscumb -->
                <div class="flex items-center text-[14px] pt-[25px]">
                    <span class="px-1 cursor-pointer"
                        onclick="window.location.href='http://localhost/PharmaDI-Admin/product/product-list.php'">Danh
                        sách sản phẩm</span>
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.09327 0.692102C1.35535 0.467463 1.74991 0.497814 1.97455 0.759893L6.97455 6.59323C7.17517 6.82728 7.17517 7.17266 6.97455 7.40672L1.97455 13.24C1.74991 13.5021 1.35535 13.5325 1.09327 13.3078C0.831188 13.0832 0.800837 12.6886 1.02548 12.4266L5.67684 6.99997L1.02548 1.57338C0.800837 1.3113 0.831188 0.916741 1.09327 0.692102Z"
                            fill="#0091D0" />
                    </svg>
                    <span class="text-[#0091D0] px-1 font-[600]">Thêm mới sản phẩm</span>
                </div>
                <!-- Title -->
                <span class="text-[19px] font-[600] text-[#0091D0] py-[20px]">THÊM MỚI SẢN PHẨM</span>
                <!-- Textbox -->
                <div class="flex w-full justify-between mt-1">
                    <div class="relative w-full mr-3">
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Mã sản phẩm</span>
                        <input type="text" name="prodId"
                            class="px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                    </div>
                    <div class="relative w-full mr-3">
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Trạng thái</span>
                        <input type="text" value="0" class="hidden" name="prodStatus">
                        <input type="text"
                            class="px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px]"
                            value="Chờ duyệt" readonly>
                        </svg>
                    </div>
                    <div class="relative w-full mr-3" onclick="showDroplist('cate-droplist')" id='product-cate'>
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Danh mục</span>
                        <input type="text" value="" class="hidden" name="prodCateId">
                        <input type="text"
                            class="cursor-pointer px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]"
                            readonly>
                        <svg class="absolute right-[10px] top-[11px]" width="15" height="15" viewBox="0 0 15 15"
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
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Tag</span>
                        <input type="text" value="" class="hidden" name="prodTagId">
                        <input type="text" readonly
                            class="px-2.5 cursor-pointer pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                        <svg class="absolute right-[10px] top-[11px]" width="15" height="15" viewBox="0 0 15 15"
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
                <div class="relative flex justify-between mt-5 w-full">
                    <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Tên sản phẩm</span>
                    <input type="text" name="prodName"
                        class="px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                </div>
                <div class="flex justify-between mt-5">
                    <div class="relative mr-3 w-full" onclick="showDroplist('brand-droplist')" id="product-brand">
                        <span
                            class="text-[13px] cursor-pointer absolute px-[5px] bg-white -top-[10px] left-[15px]">Thương
                            hiệu</span>
                        <input type="text" value="" class="hidden" name="prodBrandId">
                        <input type="text" readonly
                            class="cursor-pointer px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                        <svg class="absolute right-[10px] top-[11px]" width="15" height="15" viewBox="0 0 15 15"
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
                    <div class="relative mr-3 w-full" onclick="showDroplist('country-droplist')" id='product-country'>
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Quốc gia</span>
                        <input type="text" readonly name="prodCountry"
                            class="px-2.5 cursor-pointer pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                        <svg class="absolute right-[10px] top-[11px]" width="15" height="15" viewBox="0 0 15 15"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.76911 5.31995C2.93759 5.12339 3.23351 5.10063 3.43007 5.26911L7.50001 8.75763L11.57 5.26911C11.7665 5.10063 12.0624 5.12339 12.2309 5.31995C12.3994 5.51651 12.3766 5.81243 12.1801 5.98091L7.80507 9.73091C7.62953 9.88138 7.37049 9.88138 7.19495 9.73091L2.81995 5.98091C2.62339 5.81243 2.60063 5.51651 2.76911 5.31995Z"
                                fill="#1C274C" />
                        </svg>
                        <div class="absolute flex flex-col bg-white z-10 w-full py-1 rounded-[6px] border border-[#d8d8d8] text-[13px] hidden max-h-[200px] overflow-y-scroll"
                            id="country-droplist">
                            <?php foreach ($countries as $country): ?>
                                <span class="hover:bg-gray-100 px-[20px] py-[2px] text-[#505050]"
                                    onclick="select('product-country', '<?= $country->{'name'}->{'common'} ?>' )"><?= $country->{'name'}->{'common'} ?></span>
                            <?php endforeach; ?>
                        </div>

                    </div>
                    <div class="relative mr-3 w-full">
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Đơn vị</span>
                        <input type="text" name="prodUnit"
                            class="px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                    </div>
                    <div class="relative w-full">
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Đã bán</span>
                        <input type="text" value="0" name="prodSellNumber"
                            class="px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px]"
                            readonly>
                    </div>
                </div>
                <div class="flex w-full items-center justify-between">
                    <div class="relative w-full flex mt-5">
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Giá gốc</span>
                        <input type="text" name="prodPrice"
                            class="px-2.5 pl-[20px] py-[8px] w-full mr-3 border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                    </div>
                    <div class="relative w-full flex mt-5">
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Giá khuyến
                            mãi</span>
                        <input type="text" name="prodPriceSale"
                            class="px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px]">
                    </div>
                </div>
                <div class="relative flex justify-between mt-5 w-full">
                    <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Thành phần</span>
                    <textarea name="prodIngredient" id=""
                        class="h-max min-h-[60px] px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px] resize-none"></textarea>
                </div>
                <div class="relative flex justify-between mt-5 w-full">
                    <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Dạng bào chế</span>
                    <textarea name="prodDosageForms" id=""
                        class="h-max min-h-[60px] px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px] resize-none"></textarea>
                </div>
                <div class="relative flex justify-between mt-5 w-full">
                    <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Liều dùng</span>
                    <textarea name="prodDosage" id=""
                        class="h-max min-h-[60px] px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px] resize-none"></textarea>
                </div>
                <div class="relative flex justify-between mt-5 w-full">
                    <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Mô tả sản phẩm</span>
                    <textarea name="prodDescript" id=""
                        class="h-max min-h-[100px] px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px] resize-none"></textarea>
                </div>
                <!-- Upload picture -->
                <div class="flex">
                    <div onclick="getImage()" id="img"
                        class="w-[120px] mr-5 h-[120px] border border-dashed border-[#d8d8d8] rounded-[8px] mt-5 flex flex-col justify-center items-center cursor-pointer">
                        <input type="file" id="image" style="display: none;" #inputUpload onchange="getImageInfo()"
                            multiple>
                        <input type="hidden" name="prodImg" id="prodImg">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5535 2.49392C12.4114 2.33852 12.2106 2.25 12 2.25C11.7894 2.25 11.5886 2.33852 11.4465 2.49392L7.44648 6.86892C7.16698 7.17462 7.18822 7.64902 7.49392 7.92852C7.79963 8.20802 8.27402 8.18678 8.55352 7.88108L11.25 4.9318V16C11.25 16.4142 11.5858 16.75 12 16.75C12.4142 16.75 12.75 16.4142 12.75 16V4.9318L15.4465 7.88108C15.726 8.18678 16.2004 8.20802 16.5061 7.92852C16.8118 7.64902 16.833 7.17462 16.5535 6.86892L12.5535 2.49392Z"
                                fill="#505050" />
                            <path
                                d="M3.75 15C3.75 14.5858 3.41422 14.25 3 14.25C2.58579 14.25 2.25 14.5858 2.25 15V15.0549C2.24998 16.4225 2.24996 17.5248 2.36652 18.3918C2.48754 19.2919 2.74643 20.0497 3.34835 20.6516C3.95027 21.2536 4.70814 21.5125 5.60825 21.6335C6.47522 21.75 7.57754 21.75 8.94513 21.75H15.0549C16.4225 21.75 17.5248 21.75 18.3918 21.6335C19.2919 21.5125 20.0497 21.2536 20.6517 20.6516C21.2536 20.0497 21.5125 19.2919 21.6335 18.3918C21.75 17.5248 21.75 16.4225 21.75 15.0549V15C21.75 14.5858 21.4142 14.25 21 14.25C20.5858 14.25 20.25 14.5858 20.25 15C20.25 16.4354 20.2484 17.4365 20.1469 18.1919C20.0482 18.9257 19.8678 19.3142 19.591 19.591C19.3142 19.8678 18.9257 20.0482 18.1919 20.1469C17.4365 20.2484 16.4354 20.25 15 20.25H9C7.56459 20.25 6.56347 20.2484 5.80812 20.1469C5.07435 20.0482 4.68577 19.8678 4.40901 19.591C4.13225 19.3142 3.9518 18.9257 3.85315 18.1919C3.75159 17.4365 3.75 16.4354 3.75 15Z"
                                fill="#505050" />
                        </svg>
                        <span class="text-[13px]">Tải ảnh</span>
                    </div>
                    <div id='imgContainer' class="mr-5 h-[120px] mt-5 flex justify-center items-center cursor-pointer">
                    </div>

                </div>
                <div class="justify-end flex mt-5">
                    <button type="submit"
                        class="text-[12px] bg-[#15A5E3] text-white rounded-[6px] px-[14px] py-[7px]">Thêm mới</button>
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

    var file = document.getElementById('image');

    function getImage() {
        file.click();
    }

    list = []

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