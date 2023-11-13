<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../asset/image/logo-shortcut.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Chi tiết tin tức</title>
    <style>
        body {
            font-family: "Inter";
            height: 100vh;
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <form class="flex justify-between" action="action-create.php" method="POST">
        <div class="menu bg-[#0091D0] w-[13%] max-h min-h-[750px]">a</div>
        <div class="w-[87%]">
            <!-- Menu -->
            <div
                class="flex justify-between items-center w-full border-solid border-[#d8d8d8] border pb-2.5 pt-2 shadow-md">
                <svg class="mx-[40px]" width="30" height="31" viewBox="0 0 30 31" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M25.9375 9.25C25.9375 9.76777 25.5178 10.1875 25 10.1875L5 10.1875C4.48223 10.1875 4.0625 9.76777 4.0625 9.25C4.0625 8.73223 4.48223 8.3125 5 8.3125L25 8.3125C25.5178 8.3125 25.9375 8.73223 25.9375 9.25Z"
                        fill="#0091D0" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M25.9375 15.5C25.9375 16.0178 25.5178 16.4375 25 16.4375L5 16.4375C4.48223 16.4375 4.0625 16.0178 4.0625 15.5C4.0625 14.9822 4.48223 14.5625 5 14.5625L25 14.5625C25.5178 14.5625 25.9375 14.9822 25.9375 15.5Z"
                        fill="#0091D0" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M25.9375 21.75C25.9375 22.2678 25.5178 22.6875 25 22.6875L5 22.6875C4.48223 22.6875 4.0625 22.2678 4.0625 21.75C4.0625 21.2322 4.48223 20.8125 5 20.8125L25 20.8125C25.5178 20.8125 25.9375 21.2322 25.9375 21.75Z"
                        fill="#0091D0" />
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
            <!-- Content -->
            <div class="flex flex-col px-[40px] py-[20px] text-[#505050]">
                <!-- Breadscumb -->
                <div class="flex items-center text-[14px]">
                    <span onclick="window.location.href='http://localhost/PharmaDI-Admin/news/news-list.php'" class="px-1">Danh sách tin tức</span>
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.09327 0.692102C1.35535 0.467463 1.74991 0.497814 1.97455 0.759893L6.97455 6.59323C7.17517 6.82728 7.17517 7.17266 6.97455 7.40672L1.97455 13.24C1.74991 13.5021 1.35535 13.5325 1.09327 13.3078C0.831188 13.0832 0.800837 12.6886 1.02548 12.4266L5.67684 6.99997L1.02548 1.57338C0.800837 1.3113 0.831188 0.916741 1.09327 0.692102Z"
                            fill="#0091D0" />
                    </svg>
                    <span class="text-[#0091D0] px-1 font-[600]">Thêm mới tin tức</span>
                </div>
                <!-- Title -->
                <span class="text-[19px] font-[600] text-[#0091D0] py-[20px]">THÊM MỚI TIN TỨC</span>
                <!-- Textbox -->
                <div class="flex justify-between mt-1 items-center max-h-[40px]">
                    <div class="relative">
                        <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Tiêu đề</span>
                        <input type="text" name="newsTitle"
                            class="px-2.5 pl-[20px] py-[10px] w-[850px] border border-solid border-[#d8d8d8] rounded-[6px] focus-within:border-[#0091D0] focus-within:border focus-within:border-solid outline-0 text-[13px] h-[40px]">
                    </div>
                    <div class="relative">
                        <input type="file" id="image" class="hidden" #inputUpload
                            onchange="getImageInfo()">
                        <input name="newsData" id="newsData" class="hidden">
                        <input name="newsImgTitle" id="newsImgTitle" class="hidden">
                        <button type="button"
                            class="flex relative cursor-pointer border border-solid rounded-[6px] border-[#d8d8d8] px-2.5 pl-[20px] py-[10px] w-[350px] h-[40px]"
                            onclick="getImage()">
                            <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Ảnh</span>
                            <span id="imgName" class="absolute text-[12px] top-2.5 truncate max-w-[300px]"></span>
                            <svg class="absolute right-2 top-2" width="16" height="16" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.40465 2.80202C9.85691 0.454666 13.822 0.454666 16.2742 2.80202C18.7419 5.16412 18.7419 9.00565 16.2742 11.3678L9.65086 17.7078C7.90914 19.375 5.0961 19.375 3.35438 17.7078C1.59724 16.0258 1.59724 13.287 3.35438 11.6051L9.88246 5.35627C10.9136 4.36921 12.5747 4.36921 13.6058 5.35627C14.6524 6.35808 14.6524 7.99414 13.6058 8.99595L7.0301 15.2904C6.78074 15.529 6.38511 15.5204 6.14643 15.271C5.90774 15.0217 5.91639 14.6261 6.16574 14.3874L12.7415 8.09296C13.2739 7.58334 13.2739 6.76888 12.7415 6.25926C12.1937 5.73488 11.2946 5.73488 10.7468 6.25926L4.21873 12.508C2.97579 13.6978 2.97579 15.615 4.21874 16.8048C5.47709 18.0093 7.52814 18.0093 8.7865 16.8048L15.4099 10.4648C17.3634 8.59485 17.3634 5.57492 15.4099 3.70501C13.441 1.82034 10.2379 1.82034 8.269 3.70501L2.93218 8.8135C2.68283 9.05219 2.28719 9.04354 2.04851 8.79419C1.80982 8.54483 1.81847 8.1492 2.06782 7.91052L7.40465 2.80202Z"
                                    fill="#505050" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Content inside -->
                <div class="relative flex justify-between mt-5 w-full">
                    <span class="text-[13px] absolute px-[5px] bg-white -top-[10px] left-[15px]">Nội dung</span>
                    <textarea name="newsContent" id="" cols="30"
                        class="max-h min-h-[300px] overflow-y-scroll px-2.5 pl-[20px] py-[10px] w-[100%] border border-solid border-[#d8d8d8] rounded-[6px] outline-0 text-[13px] resize-none"></textarea>
                </div>
                <!-- Button -->
                <div class="justify-end flex mt-5">
                    <!-- <button
                        class="text-[12px] border border-solid border-[#d8d8d8] rounded-[6px] px-[14px] py-[7px] mr-3">Huỷ
                        bỏ</button> -->
                    <button class="text-[12px] bg-[#15A5E3] text-white rounded-[6px] px-[14px] py-[7px]"
                        type="submit">Thêm
                        mới</button>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
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