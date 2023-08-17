<?php  
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];
?>   
<div class="min-h-[715px] bg-[#0071AF]">
<div class="text-white text-[30px] pt-[35px] pb-4 text-center z-20 relative">PHARMADI</div>
<div onclick="window.location.href=''" class="relative flex justify-center w-full cursor-pointer z-10">
    <span class="text-[14px] py-[10px] z-10 <?= strpos($url, '/PharmaDI-Admin/home') ? 'text-blue-700' : 'text-white' ?>">Trang chủ</span>
    <div class="absolute w-full h-full ml-[40px] bg-white rounded-l-full z-0 <?= strpos($url, '/PharmaDI-Admin/home') ? '' : 'hidden' ?>">
        <div class="absolute w-[20px] h-[20px] -top-[20px] right-[20px] bg-white">
            <div class="absolute bg-[#0071AF] rounded-full bottom-0 right-0 w-[40px] h-[40px]"></div>
        </div>
        <div class="absolute w-[20px] h-[20px] -bottom-[20px] right-[20px] bg-white">
            <div class="absolute bg-[#0071AF] rounded-full top-0 right-0 w-[40px] h-[40px]"></div>
        </div>
    </div>
</div>
<div onclick="window.location.href='http://localhost/PharmaDI-Admin/product/product-list.php'" class="relative flex justify-center w-full cursor-pointer z-10 mt-[20px]">
    <span class="text-[14px] <?= strpos($url, '/PharmaDI-Admin/product') ? 'text-blue-700' : 'text-white' ?> py-[10px] z-10">Sản phẩm</span>
    <div class="absolute w-full h-full ml-[40px] bg-white rounded-l-full z-0 <?= strpos($url, '/PharmaDI-Admin/product') ? '' : 'hidden' ?>">
        <div class="absolute w-[20px] h-[20px] -top-[20px] right-[20px] bg-white">
            <div class="absolute bg-[#0071AF] rounded-full bottom-0 right-0 w-[40px] h-[40px]"></div>
        </div>
        <div class="absolute w-[20px] h-[20px] -bottom-[20px] right-[20px] bg-white">
            <div class="absolute bg-[#0071AF] rounded-full top-0 right-0 w-[40px] h-[40px]"></div>
        </div>
    </div>
</div>
<div onclick="window.location.href='http://localhost/PharmaDI-Admin/customer/customer-list.php'" class="relative flex justify-center w-full cursor-pointer z-10 mt-[20px]">
    <span class="text-[14px] <?= strpos($url, '/PharmaDI-Admin/customer') ? 'text-blue-700' : 'text-white' ?> py-[10px] z-10">Khách hàng</span>
    <div class="absolute w-full h-full ml-[40px] bg-white rounded-l-full z-0 <?= strpos($url, '/PharmaDI-Admin/customer') ? '' : 'hidden' ?>">
        <div class="absolute w-[20px] h-[20px] -top-[20px] right-[20px] bg-white">
            <div class="absolute bg-[#0071AF] rounded-full bottom-0 right-0 w-[40px] h-[40px]"></div>
        </div>
        <div class="absolute w-[20px] h-[20px] -bottom-[20px] right-[20px] bg-white">
            <div class="absolute bg-[#0071AF] rounded-full top-0 right-0 w-[40px] h-[40px]"></div>
        </div>
    </div>
</div>
<div onclick="window.location.href=''" class="relative flex justify-center w-full cursor-pointer z-10 mt-[20px]">
    <span class="text-[14px] <?= strpos($url, '/PharmaDI-Admin/order') ? 'text-blue-700' : 'text-white' ?> py-[10px] z-10">Đơn hàng</span>
    <div class="absolute w-full h-full ml-[40px] bg-white rounded-l-full z-0 <?= strpos($url, '/PharmaDI-Admin/order') ? '' : 'hidden' ?>">
        <div class="absolute w-[20px] h-[20px] -top-[20px] right-[20px] bg-white">
            <div class="absolute bg-[#0071AF] rounded-full bottom-0 right-0 w-[40px] h-[40px]"></div>
        </div>
        <div class="absolute w-[20px] h-[20px] -bottom-[20px] right-[20px] bg-white">
            <div class="absolute bg-[#0071AF] rounded-full top-0 right-0 w-[40px] h-[40px]"></div>
        </div>
    </div>
</div>
<div onclick="window.location.href=''" class="relative flex justify-center w-full cursor-pointer z-10 mt-[20px]">
    <span class="text-[14px] <?= strpos($url, '/PharmaDI-Admin/account') ? 'text-blue-700' : 'text-white' ?> py-[10px] z-10">Tài khoản</span>
    <div class="absolute w-full h-full ml-[40px] bg-white rounded-l-full z-0 <?= strpos($url, '/PharmaDI-Admin/account') ? '' : 'hidden' ?>">
        <div class="absolute w-[20px] h-[20px] -top-[20px] right-[20px] bg-white">
            <div class="absolute bg-[#0071AF] rounded-full bottom-0 right-0 w-[40px] h-[40px]"></div>
        </div>
        <div class="absolute w-[20px] h-[20px] -bottom-[20px] right-[20px] bg-white">
            <div class="absolute bg-[#0071AF] rounded-full top-0 right-0 w-[40px] h-[40px]"></div>
        </div>
    </div>
</div>
</div>