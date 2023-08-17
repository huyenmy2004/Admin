<?php
require_once "pdo.php";

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
    <div class="container1">
        <div class="label-add-brand">
            <h1>THÊM THƯƠNG HIỆU MỚI</h1>
            <form id="add-brand-form" action="process-add-brand.php" method="POST">
                <div class="brand-name">
                    <label class="label-brand-name">Tên thương hiệu</label>
                    <input type="text" name="input-brand" class="input-brand" placeholder="Nhập tên thương hiệu" required>
                </div>
                <div class="brand-logo">
                    <label class="label-brand-logo">Logo</label>
                    <input type="text" name="input-logo" class="input-logo" placeholder="Đính kèm logo" required>
                </div>
                <div class="brand-descript">
                    <label class="label-brand-descript">Mô tả</label>
                    <textarea class="input-brand-descript" rows="4" placeholder="Nhập mô tả" required></textarea>

                </div>
                <div class="buttons">
            <button type="button" class="btn-cancel">Hủy bỏ</button>
            <button type="submit" class="btn-create">Thêm mới</button>
            
        </div>

            </form>
        </div>
    </div>

    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const btnCancel = document.querySelector(".btn-cancel");

        btnCancel.addEventListener("click", function () {
            // Chuyển hướng về trang brand (hoặc trang bạn muốn)
            window.location.href = "brand-addmin.php";
        });
    });
</script>
        <script>
    function addBrand() {
        // Lấy dữ liệu từ các trường input
        const brandName = document.querySelector("[name='input-brand']").value;
        const brandLogo = document.querySelector("[name='input-logo']").value;
        const brandDescription = document.querySelector("[name='input-brand-descript']").value;

        // Tạo đối tượng FormData và thêm dữ liệu
        const formData = new FormData();
        formData.append('input-brand', brandName);
        formData.append('input-logo', brandLogo);
        formData.append('input-brand-descript', brandDescription);

        // Gửi yêu cầu POST thông qua Fetch API
        fetch("process-add-brand.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            // Xử lý kết quả từ máy chủ (nếu cần)..
            console.log(result);
            // Cập nhật dữ liệu trên trang web (nếu cần)
        })
        .catch(error => {
            console.error("Lỗi khi gửi yêu cầu POST:", error);
        });
    }
</script>
</body>
</html>
