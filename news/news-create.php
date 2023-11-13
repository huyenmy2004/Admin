<?php
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/images/logo-shortcut.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Bài đăng</title>
</head>
<style>
    body {
        font-family: "Inter";
        height: 100vh;
        min-height: 100vh;
    }

    .news-list {
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
    <form method="post" action="action-create.php" id='form-news-search' class="flex justify-between">
        <div class="max-h min-h-vh">
            <?php require_once '../menu.php'; ?>
        </div>
        <div class="bg-white m-8 box w-full">
            <!--Search-->
            <div class="flex justify-between w-full mt-5 px-[50px] py-[25px] flex-col text-[#505050]">
                <!-- Breadscumb -->
                <div class="flex items-center text-[14px]">
                    <span class="px-1 cursor-pointer"
                        onclick="window.location.href='http://localhost/PharmaDI-Admin/news/news-list.php'">Danh sách
                        tin tức</span>
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.09327 0.692102C1.35535 0.467463 1.74991 0.497814 1.97455 0.759893L6.97455 6.59323C7.17517 6.82728 7.17517 7.17266 6.97455 7.40672L1.97455 13.24C1.74991 13.5021 1.35535 13.5325 1.09327 13.3078C0.831188 13.0832 0.800837 12.6886 1.02548 12.4266L5.67684 6.99997L1.02548 1.57338C0.800837 1.3113 0.831188 0.916741 1.09327 0.692102Z"
                            fill="#0091D0" />
                    </svg>
                    <span class="text-[#0091D0] px-1 font-[600]">Thêm mới tin tức</span>
                </div>
                <!-- Title -->
                <div class="flex justify-between items-center py-[25px]">
                    <span class="text-[#0091D0] font-[600]">THÊM MỚI TIN TỨC</span>

                </div>
                <div class="flex flex-col">
                    <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Tiêu đề</span>
                    <input type="text" name="newsTitle" 
                        class="px-2.5 pl-[20px] py-[10px] w-full border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] h-[40px]">

                </div>
                <div class="flex flex-col mt-3">
                    <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Ảnh đính kèm</span>
                    <input type="file" id="image" class="hidden" #inputUpload onchange="getImageInfo()">
                    <input name="newsData" id="newsData" class="hidden" >
                    <input name="newsImgTitle" id="newsImgTitle" class="hidden">
                    <button type="button"
                        class="flex relative cursor-pointer border border-solid rounded-[6px] border-[#d8d8d8] px-2.5 pl-[20px] py-[10px] w-full h-[40px]"
                        onclick="getImage()">
                        <span id="imgName" class="absolute text-[12px] top-2.5 truncate max-w-[300px]">
                        </span>
                        <svg class="absolute right-2 top-2" width="16" height="16" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.40465 2.80202C9.85691 0.454666 13.822 0.454666 16.2742 2.80202C18.7419 5.16412 18.7419 9.00565 16.2742 11.3678L9.65086 17.7078C7.90914 19.375 5.0961 19.375 3.35438 17.7078C1.59724 16.0258 1.59724 13.287 3.35438 11.6051L9.88246 5.35627C10.9136 4.36921 12.5747 4.36921 13.6058 5.35627C14.6524 6.35808 14.6524 7.99414 13.6058 8.99595L7.0301 15.2904C6.78074 15.529 6.38511 15.5204 6.14643 15.271C5.90774 15.0217 5.91639 14.6261 6.16574 14.3874L12.7415 8.09296C13.2739 7.58334 13.2739 6.76888 12.7415 6.25926C12.1937 5.73488 11.2946 5.73488 10.7468 6.25926L4.21873 12.508C2.97579 13.6978 2.97579 15.615 4.21874 16.8048C5.47709 18.0093 7.52814 18.0093 8.7865 16.8048L15.4099 10.4648C17.3634 8.59485 17.3634 5.57492 15.4099 3.70501C13.441 1.82034 10.2379 1.82034 8.269 3.70501L2.93218 8.8135C2.68283 9.05219 2.28719 9.04354 2.04851 8.79419C1.80982 8.54483 1.81847 8.1492 2.06782 7.91052L7.40465 2.80202Z"
                                fill="#505050" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col mt-3">
                    <span class="text-[13px] px-[5px] bg-white font-[600] pl-5 pb-1">Nội dung</span>
                    <textarea name="newsContent"
                        class="min-h-[300px] px-2.5 pl-[20px] py-[10px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] resize-none"></textarea>

                </div>
                <div class="justify-end flex mt-5">
                    <button
                        class="text-[12px] border border-solid border-[#d8d8d8] rounded-[6px] px-[14px] py-[7px] mr-3">Huỷ
                        bỏ</button>
                    <button class="text-[12px] bg-[#15A5E3] text-white rounded-[6px] px-[14px] py-[7px]"
                        type="submit">Thêm mới</button>
                </div>
            </div>
            <div class="flex flex-col px-[50px] py-[25px]">
            </div>
        </div>
    </form>
</body>
<script>
    function showDroplist(id) {
        var dropList = document.getElementById(id);
        dropList.classList.toggle('hidden');
        console.log(dropList.getElementsByTagName('span'))
    }
    var file = document.getElementById('image');
    function getImage() {
        file.click();
    }
    function getImageInfo() {
        document.getElementById('imgName').innerHTML = file.files[0].name;
        document.getElementById('newsImgTitle').value = file.files[0].name
        let fileReader = new FileReader();
        fileReader.readAsDataURL(file.files[0])
        fileReader.onload = (e) => {
            // var img = document.createElement('img');
            document.getElementById('newsData').value = e.target.result
        }
    }
</script>