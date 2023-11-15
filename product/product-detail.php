<!DOCTYPE html>
<html lang="en">
<?php
require_once "product-pdo.php";
$product = new Product();
$prod = $product->prodDetail($_GET['prodId']);
$prodImg = $product->prodDetailImg($_GET['prodId']);
$brand = new Brand();
$brands = $brand->getData();
$tag = new Tag();
$tags = $tag->getData();
$cate = new Category();
$cates = $cate->getData();

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
        .box{
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
            <div class="flex justify-between w-full mt-5 px-[50px] py-[25px] flex-col text-[#505050]">
                <!-- Breadscumb -->
                <div class="flex items-center text-[14px]">
                    <span class="px-1 cursor-pointer"
                        onclick="window.location.href='http://localhost/PharmaDI-Admin/product/product-list.php'">Danh
                        sách sản phẩm</span>
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.09327 0.692102C1.35535 0.467463 1.74991 0.497814 1.97455 0.759893L6.97455 6.59323C7.17517 6.82728 7.17517 7.17266 6.97455 7.40672L1.97455 13.24C1.74991 13.5021 1.35535 13.5325 1.09327 13.3078C0.831188 13.0832 0.800837 12.6886 1.02548 12.4266L5.67684 6.99997L1.02548 1.57338C0.800837 1.3113 0.831188 0.916741 1.09327 0.692102Z"
                            fill="#0091D0" />
                    </svg>
                    <span class="text-[#0091D0] px-1 font-[600]">Chi tiết sản phẩm</span>
                </div>
                <!-- Title -->
                <div class="flex justify-between items-center py-[25px]">
                    <span class="text-[#0091D0] font-[600]">CHI TIẾT SẢN PHẨM</span>
                    <button type="button"
                        onclick="window.location.href='http://localhost/PharmaDI-Admin/product/product-edit.php?prodId=<?= $prod['SKU'] ?>'"
                        class="border-[#15A5E3] border border-solid px-[12px] py-[5px] text-[13px] rounded-[8px] text-[#0091D0]">Chỉnh
                        sửa</button>
                </div>
                <!-- Textbox -->
                <div class="flex w-full justify-between ">
                    <div class="w-full mr-3">
                        <span class="text-[13px] px-1 py-1 font-[600] ">Mã sản phẩm</span>
                        <input readonly type="text" value="<?= $prod['SKU'] ?>" name="prodId"
                            class="px-2.5 bg-[#f2f2f2] pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px]">
                    </div>
                    <div class="w-full mr-3">
                        <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Trạng thái</span>
                        <input type="text" name="prodStatus"
                            value="<?= $prod['prodStatus'] == 0 ? "Chờ duyệt" : ($prod['prodStatus'] == 1 ? "Đã duyệt" : "Không duyệt") ?>"
                            class="px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px]"
                            value="Chờ duyệt" readonly>
                        </svg>
                    </div>
                    <div class="w-full mr-3">
                        <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Danh mục</span>
                        <input type="text" value="<?php
                        foreach ($cates as $cate)
                            if ($prod['cateId'] == $cate['cateId'])
                                echo $cate['cateName'];
                        ?>"
                            class="px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px]  outline-0 text-[13px]"
                            readonly>
                    </div>
                    <div class="w-full">
                        <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Tag</span>
                        <input type="text" readonly value="<?php foreach ($tags as $tag)
                            if ($prod['tagId'] == $tag['tagId'])
                                echo $tag['tagName'];
                        ?>"
                            class="px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px]">
                    </div>
                </div>
                <div class="w-full flex justify-between mt-2 w-full flex-col">
                    <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Tên sản phẩm</span>
                    <input type="text" name="prodName" value="<?= $prod['prodName'] ?>" readonly
                        class="px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px]  outline-0 text-[13px]">
                </div>
                <div class="flex w-full justify-between mt-2">
                    <div class="w-full mr-3" onclick="showDroplist('brand-droplist')" id="product-brand">
                        <span class="text-[13px]  px-1mr-3 bg-white font-[600]">Thương
                            hiệu</span>
                        <input type="text" readonly value="<?php foreach ($brands as $brand)
                            if ($prod['brandId'] == $brand['brandId'])
                                echo $brand['brandName'];
                        ?>"
                            class="px-2.5 pl-[20px] py-[8px] mr-3 w-full border border-solid border-[#d8d8d8] rounded-[6px]  outline-0 text-[13px]">
                    </div>
                    <div class="w-full mr-3">
                        <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Quốc gia</span>
                        <input type="text" readonly name="prodCountry" value="<?= $prod['prodCountry'] ?>"
                            class="px-2.5 pl-[20px] py-[8px] w-full mr-3 border border-solid border-[#d8d8d8] rounded-[6px]  outline-0 text-[13px]">
                    </div>
                    <div class="w-full mr-3">
                        <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Đơn vị</span>
                        <input readonly value="<?= $prod['prodUnit'] ?>" type="text" name="prodUnit"
                            class="px-2.5 pl-[20px] py-[8px] w-full mr-3 border border-solid border-[#d8d8d8] rounded-[6px]  outline-0 text-[13px]">
                    </div>
                    <div class="w-full">
                        <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Đã bán</span>
                        <input type="text" value="<?= $prod['prodSellNumber'] ?>" name="prodSellNumber"
                            class="px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px]"
                            readonly>
                    </div>
                </div>
                <div class="flex w-full items-center justify-between mr-3">
                    <div class="w-full flex mt-2 mr-3 flex-col">
                        <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Giá gốc</span>
                        <input readonly value="<?= $prod['prodPrice'] ?>" type="text" name="prodPrice"
                            class="px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px]  outline-0 text-[13px]">
                    </div>
                    <div class="w-full flex mt-2 flex-col">
                        <span class="text-[13px] px-1 bg-white pb-1 font-[600]">Giá khuyến
                            mãi</span>
                        <input readonly value="<?= $prod['prodPriceSale'] ?>" type="text" name="prodPriceSale"
                            class="px-2.5 pl-[20px] py-[8px] w-full border border-solid border-[#d8d8d8] rounded-[6px]  outline-0 text-[13px]">
                    </div>
                </div>
                <div class="w-full flex justify-between mt-2 w-full flex-col">
                    <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Thành phần</span>
                    <textarea readonly name="prodIngredient" value="<?= $prod['prodIngredient'] ?>"
                        class="h-max min-h-[60px] px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px]  outline-0 text-[13px] resize-none"><?= $prod['prodIngredient'] ?></textarea readonly>
                </div>
                <div class="w-full flex justify-between mt-2 w-full flex-col">
                    <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Dạng bào chế</span>
                    <textarea readonly name="prodDosageForms" value="<?= $prod['prodDosageForms'] ?>"
                        class="h-max min-h-[60px] px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px]  outline-0 text-[13px] resize-none"><?= $prod['prodDosageForms'] ?></textarea readonly>
                </div>
                <div class="w-full flex justify-between mt-2 w-full flex-col">
                    <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Liều dùng</span>
                    <textarea readonly name="prodDosage" value="<?= $prod['prodDosage'] ?>"
                        class="h-max min-h-[60px] px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px]  outline-0 text-[13px] resize-none"><?= $prod['prodDosage'] ?></textarea readonly>
                </div>
                <div class="w-full flex justify-between mt-2 w-full flex-col">
                    <span class="text-[13px]  px-1 bg-white pb-1 font-[600]">Mô tả sản phẩm</span>
                    <textarea readonly name="prodDescript" value="<?= $prod['prodDescrip'] ?>"
                        class="h-max min-h-[100px] px-2.5 pl-[20px] py-[8px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px]  outline-0 text-[13px] resize-none"><?= $prod['prodDescrip'] ?></textarea>
                </div>
                <!-- Upload picture -->
                <div class="flex w-full">
                    <div id='imgContainer' class="mr-5 h-[150px]  mt-5 flex justify-center items-center">
                        <?php foreach ($prodImg as $img): ?>
                            <img src="<?= $img['imgPath']; ?>" alt=""
                                class="max-h-full mr-[20px] object-cover rounded-[8px] p-[8px] border border-dashed border-[#d8d8d8]">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </form>
                        </div>
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

    function getImage() {
        file.click();
    }

    function getImageInfo() {
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