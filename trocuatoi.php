<?php


if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    $userid = $_COOKIE['id'];
    if (isset($_GET['index'])) {
        $index = $_GET['index'];
    }
    // Specify the path to your JSON file
    $jsonFilePathTro = './tro.json';
    $jsonFilePathUser = './account.json';
    
    $jsonContents = file_get_contents($jsonFilePathTro);
    $data = json_decode($jsonContents, true);

  
    $jsonUserContents = file_get_contents($jsonFilePathUser);
    $jsonUserData = json_decode($jsonUserContents, true);
    
    
} else {
    header("Location: http://127.0.0.1/sign_in");
    // header("Location: http://127.0.0.1/sign_in");
    exit(); // Make sure to exit after the redirect
} 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
            integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <style>
            #signOutBtn {
                margin: 0;
            }
            .context-menu {
                display: none;
                position: absolute;
                background-color: #fff;
                border: 1px solid #ccc;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                border-radius: 4px;
                height: auto;
            }

            .context-menu ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
            }

            .context-menu ul li {
                padding: 8px;
                cursor: pointer;
            }

            .context-menu ul li.divider {
                border-top: 1px solid #ccc;
            }

            .context-menu ul li:hover {
                background-color: #f2f2f2;
            }
            #name {
                font-size: 16px;
                display: inline;
            }

            /* Decrease text size as the viewport width decreases */
            @media (max-width: 768px) {
                #name {
                    font-size: 14px;
                }
            }

            @media (max-width: 480px) {
                #name {
                    font-size: 12px;
                }
            }

        </style>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <title>Bootstrap 5.3 Example</title>
    </head>
    <body style="background-image: url('./images/bg.png')">
        <div class="">
            <style>
                @keyframes slide {
                    0% {
                        transform: translateX(-100%);
                    }
                    100% {
                        transform: translateX(100%);
                    }
                }

                .animated-text {
                    white-space: nowrap;
                    overflow: hidden;
                    animation: slide 15s linear infinite;
                }
            </style>
            <p style="font-size: 25px" class="animated-text">Trọ Trực Tuyến: Website thuê trọ uy tín chất lượng số 1 Việt Nam.</p>
            <ul id="nav-tab" style="background-color: aliceblue" class="nav nav-tabs sticky-top p-2">
                <li class="nav-item">
                    <!-- http://127.0.0.1 -->
                    <!-- http://127.0.0.1 -->
                    <a
                        class="nav-link"
                        id="Home-tab"
                        href="http://127.0.0.1"
                        >Trang chủ</a
                    >
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="Product-tab"
                        href="http://127.0.0.1?tab=1"
                        >Tìm trọ</a
                    >
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="Contact-tab"
                        href="#"
                        >Cho thuê</a
                    >
                    <script>
                        var choThue = document.querySelector("#Contact-tab");
                        choThue.addEventListener("click",() => {
                            if(getCookie('role') == '1') {
                                swal("Lỗi", "Phần này chỉ dành cho người cho thuê")

                            }else {
                                // href="http://127.0.0.1?tab=2"
                                // 127.0.0.1
                                window.location.href = "http://127.0.0.1?tab=2";

                            }
                        });
                    </script>
                </li>
                <li
                    style="flex: 1; flex-direction: row-reverse; display: flex"
                    class="nav-item "
                >
                
                <button class="btn shadow" id="user_btn">
                <img style="height: 20px;" src="../images/sex/<?php
                    $avatar = $_COOKIE['avatar'];
                    echo $avatar;
                ?>"/>
                    <div id="name"><?php echo $username; ?></div>
                </button>
                
                <div class="context-menu" id="contextMenu">
                    <ul>
                        <script>
                            document
                            .querySelector(".tab-content")
                            .addEventListener("click", hideContextMenu);

                        </script>
                        <li><p href="#" id="signOutBtn">Sign Out</p></li>
                    </ul>
                </div>

                </li>
            </ul>

            <div class="tab-content container">
            <h3>Các phòng trọ của bạn <br></h3>    
            <?php
            for ($i=0; $i < count($data); $i++) {
              if ($data[$i]['userid']==$userid) {
       
              $title = $data[$i]['title'];
                                    $img = $data[$i]['images'][0];
                                    $price = $data[$i]['price'];
                                    $price = number_format($price);
                                    $address = $data[$i]['address'];
                                    $province = $data[$i]['province'];
                                    $district = $data[$i]['district'];
                                    $currentDate = date("d-m-Y H:i:s"); // Format: YYYY-MM-DD HH:MM:SS
                                    $status = $data[$i]['status'];
                                    $content = $data[$i]['content'];
                                    $buy_icon = '';
                                    if($status == 1) {
                                        $status = "Đặt ngay";
                                        $btn_display = "primary";
                                        $buy_icon = '<i class="fas fa-shopping-cart m-1"></i>';
                                    }else {
                                        $status = "Đã hết";
                                        $btn_display = "danger";

                                    }

                                    echo 
                                    '<div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="card p-1">
                                                <div class="row no-gutters">
                                                    <div class="col-md-3">
                                                        <img width="300" height="170" src="'.$img.'" alt="Image" class="card-img">
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><a class="card-text two-line-ellipsis" target="_blank" href="tro.php?index='.$i.'">'.($i + 1).'. '.$title.'</a></h5>
                                                            <p class="card-text two-line-ellipsis">'.$content.'</p>
                                                            <b>Giá tiền:</b> '.$price.' vnđ<br>
                                                            <b>Địa chỉ:</b> '.$address.', '.$district.', '.$province.'<br>
                                                            <b>Đăng tải lúc:</b> '.$currentDate.'<br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="m-2">
                                                            <div class="text-centers d-flex justify-content-center">
                                                                <div class="btn btn-'.$btn_display.' border shadow-sm">
                                                                    <a target="_blank" style="color:white" href="tro.php?index='.$i.'">
                                                                    '.$buy_icon.$status.'
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> '; }
            }
            
            ?>

          </div>
        </div>
        <div class="row mt-1 p-2" style="background-color: white;">
            <div class="col-md-10 mt-5">
                <div class="text-center" >Công ty TNHH Trọ Trực Tuyến - Người đại diện pháp luật: Vũ Trường Giang
                    <br>Địa chỉ: 175 Tây Sơn, Đống Đa, Hà Nội; Email: trogiup@chotructuyen.vn - Tổng đài CSKH: 12345678 (1.000đ/phút)
                </div>
            </div>
            <div class="col-md-2 text-center">
                <div>
                    <br>Liên kết<br><img src="https://static.chotot.com/storage/default/facebook.svg"/>
                    <img src="https://static.chotot.com/storage/default/youtube.svg"/>
                    <img src="https://static.chotot.com/storage/default/linkedin.svg"/>
                    <br>Chứng nhận<br><img src="https://static.chotot.com/storage/default/certificate.webp"/>
                    
                </div>
            </div>
        </div>
    </body>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./script.js"></script>
   
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
        showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
        showSlides(slideIndex = n);
        }

        function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        }
    </script>
    
</html>
