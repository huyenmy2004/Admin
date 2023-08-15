<?php
include "pdo.php";
if (isset($_GET['brandId'])) {
    $brandId = $_GET['brandId'];
    $brand = new Brand();
    $brandData = $brand->getBrandById($brandId);
}

?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/add-edit_brand.css">
        <title>Add New Brand</title>
    </head>
    <body>
        <div class="label-add-brand">
            <h1>CHỈNH SỬA THƯƠNG HIỆU</h1>
            <form id="add-brand-form" action="process-edit-brand.php"  method="post">
            <input type="hidden" name="brand_id" value="<?php echo $brandData['brandId']; ?>">
                <div class="brand-name">
                    <label class="label-brand-name">Tên thương hiệu</label>
                    <input type="text" name="input-brand" class="input-brand" value="<?php echo $brandData['brandName'];?>" required>
                </div>
                <div class="brand-logo">
                    <label class="label-brand-logo">Logo</label>
                    <input type="text" name="input-logo" class="input-logo" value="<?php echo $brandData['brandLogo'];?>" required>
                </div>
                <div class="brand-descript">
                    <label class="label-brand-descript">Mô tả</label>
                    <textarea class="input-brand-descript" rows="4" name="input-brand-descript" required><?php echo $brandData['brandDescription']; ?></textarea>
    
                </div>
                <div class="buttons">
        <a class="btn-drop" href="process-delete-brand.php?brandId=<?php echo $brandData['brandId'];?>&delete=true">Xóa thương hiệu</a>
        <button type="button" class="btn-cancel">Hủy bỏ</button>
        <button type="submit" class="btn-edit">Chỉnh sửa</button>
    </div>
    
            </form>
        </div>
    
        <script src="/js/add-brand.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
        const btnCancel = document.querySelector(".btn-cancel");
    
        btnCancel.addEventListener("click", function () {
            // Chuyển hướng về trang brand (hoặc trang bạn muốn)
            window.location.href = "brand-addmin.php";
        });
    });
        </script>
    </body>
    </html>
    