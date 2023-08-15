<?php
include "../connect-db.php";
include "pdo.php";

$getInfor = new Brand();
$brands = [];
// Kiểm tra nếu người dùng đã submit form tìm kiếm
if (isset($_GET['submit-search'])) {
    $searchKeyword = $_GET['search-brand'];

    // Thực hiện truy vấn để tìm kiếm brand theo nội dung chứa từ khóa
    $brands = $getInfor->searchBrandByContent($searchKeyword);
} else {
    // Nếu không có tìm kiếm, lấy tất cả dữ liệu brand
    $brands = $getInfor->getData();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/brand.css">
    <title>BRAND</title>
</head>
<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="title">PHARMADI</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="title">Trang chủ</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="title">Sản phẩm</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="title">Khách hàng</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="title">Đơn hàng</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="title">Thương hiệu</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="title">Tài khoản</span>
                    </a>
                </li>
            </ul>
        </div>
        <!--main-->
        <div class="main">
                <div class="toggle">
                    <ion-icon name="menu-outline" class="menu-icon"></ion-icon>
                </div>
        <!--user-->
                <div class="user">
                    <ion-icon name="person-circle-outline" class="user-icon"></ion-icon>
                    <div class="user-name">
                        <p>Huyen My</p>
                    </div>
                    <ion-icon name="chevron-down-outline" class="drop-down-icon"></ion-icon>
                </div>
        </div>
        <div class="content">
            <!--Content-->
<div class="create-area">
    <div class="label">
        <p>DANH SÁCH THƯƠNG HIỆU</p>
    </div>
    <!--Create box-->
    <a class="btn-create" href="add-brand.php">Thêm mới</a>
    </div>

        
        <div class="search-area">
                <div class="search-label">Tên thương hiệu</div>
                <form action="brand-addmin.php" method="GET" style="display:flex;">
                  <input type="text" name="search-brand" class="search-textbox" placeholder="Nhập tên thương hiệu bạn muốn tìm kiếm">
                  <button type="submit" class="btn btn-search" name="submit-search" value="true">Tìm kiếm</button>
                </form>
        
        </div>
    <!--Brand area-->
    <div class="manage-brand">
        <div class="brand-introduce">

                <?php 
                    if (!empty($brands)) {
                        foreach($brands as $item) {
                    ?>
                    <div class="brand-item">
                        <div class="brand-logo">
                            <img src="<?php echo $item['brandLogo'];?>" alt="" class="brand-image">
                        </div>
                        <a class="btn-edit" href="edit-brand.php?brandId=<?php echo $item['brandId'];?>">Chỉnh sửa</a>
                        <div class="label-brand-content"><?php echo $item['brandName'];?></div>
                        <div class="brand-content">
                            <p><?php echo $item['brandDescription'];?></p>
                        </div>
                    </div>
                    <?php
                            }
                        } else {
                            echo "Không có dữ liệu thương hiệu.";
                        }
                    ?>

        

    </div>

    
        </div>
        
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    

<script>



document.addEventListener("DOMContentLoaded", function () {
    const brandIntroduce = document.querySelector(".brand-introduce");
    
    if (brandIntroduce) {
        // Lấy danh sách tất cả các brand items
        const brandItems = brandIntroduce.querySelectorAll(".brand-item");
        
        // Lắng nghe sự kiện input trên ô tìm kiếm
        const searchInput = document.querySelector("[name='search-brand']");
        searchInput.addEventListener("input", function () {
            const searchKeyword = searchInput.value.toLowerCase();
            
            // Lặp qua từng brand item và ẩn hoặc hiển thị tùy theo tìm kiếm
            brandItems.forEach(function (brandItem) {
                const brandName = brandItem.querySelector(".label-brand-content").textContent.toLowerCase();
                
                // Kiểm tra xem brandName có chứa searchKeyword không
                if (brandName.includes(searchKeyword)) {
                    brandItem.style.display = "block"; // Hiển thị brand item
                } else {
                    brandItem.style.display = "none"; // Ẩn brand item
                }
            });
        });
    }
});

</script>  
  
</body>
</html>

