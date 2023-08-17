<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/asset/css/brand.css">
    <title>BRAND</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}
:root{
    --heavy_blue:#0071AF;
    --light_blue:#15a5e3;
    --white:#ffffff;
    --border:#d8d8d8;
    --text:#505050;
}
body{
    min-height: 100vh;
    overflow-x: hidden;

}
.container{
    position: relative;
    width: 100%;
}
.navigation{
    position: fixed;
    width: 200px;
    height: 100%;
    background:var(--heavy_blue);
    border-left:10px solid var(--heavy_blue);
    transition:0.5s;
    overflow:hidden;
}
.navigation ul{
    position: absolute;
    top:0;
    left:0;
    width:100%;
}
.navigation ul li{
    position: relative;
    width: 100%;
    list-style-type: none;
    border-top-left-radius: 30px;
    border-bottom-left-radius: 30px;
}

.navigation ul li:hover{
    background:var(--white);
}
.navigation ul li:nth-child(1){
    margin-bottom: 40px;
    pointer-events: none;

}
.navigation ul li a{
    position: relative;
    display: block;
    width: 100%;
    display: flex;
    text-decoration: none;
    color: var(--white);
    align-items: center;
  
}
.navigation ul li:hover a{
    color: var(--heavy_blue)
}
.navigation ul li .title{
    position: relative;
    display: block;
    padding:0 10px;
    height:60px;
    line-height: 60px;
    text-align: start;
    white-space: nowrap;
}
/*curve outside*/
.navigation ul li:hover a::before{
    content:'';
    position: absolute;
    right: 0;
    top:-50px;
    width:50px;
    height:50px;
    background:transparent;
    border-radius: 50%;
    box-shadow: 35px 35px 0 10px var(--white);
    pointer-events: none;
}
.navigation ul li:hover a::after{
    content:'';
    position: absolute;
    right: 0;
    bottom:-50px;
    width:50px;
    height:50px;
    background:transparent;
    border-radius: 50%;
    box-shadow: 35px -35px 0 10px var(--white);
    pointer-events: none;
}


    </style>
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
                        <span class="title">Sản phẩmm</span>
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

<script>



    //add hovered class in selected list item
    let list=document.querySelectorAll('.navigation li');
    function activeLink(){
        list.forEach((item)=>
        item.classList.remove('hovered'));
        this.classList.add('hovered');
    }
    list.forEach((item)=>
    item.addEventListener('mouseover', activeLink));


</script>    
</body>
</html>