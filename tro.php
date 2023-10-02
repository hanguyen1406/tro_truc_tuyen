<?php

if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    if (isset($_GET['index'])) {
        $index = $_GET['index'];
    }
    // Specify the path to your JSON file
    $jsonFilePathTro = './tro.json';
    $jsonFilePathUser = './account.json';
    
    $jsonContents = file_get_contents($jsonFilePathTro);
    $jsonData = json_decode($jsonContents, true);

    $tro = $jsonData[$index];
    $userid = $tro['userid'];
    $jsonUserContents = file_get_contents($jsonFilePathUser);
    $jsonUserData = json_decode($jsonUserContents, true);
    
    
} else {
    header("Location: http://trotot.infinityfreeapp.com/sign_in");
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
                    <!-- http://trotot.infinityfreeapp.com -->
                    <!-- http://127.0.0.1 -->
                    <a
                        class="nav-link"
                        id="Home-tab"
                        href="http://trotot.infinityfreeapp.com"
                        >Trang chủ</a
                    >
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="Product-tab"
                        href="http://trotot.infinityfreeapp.com?tab=1"
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
                                // trotot.infinityfreeapp.com
                                window.location.href = "http://trotot.infinityfreeapp.com?tab=2";

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
                <div class="row mt-1">
                    <div  class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <style>
                                    * {box-sizing:border-box}

                                    /* Slideshow container */
                                    .slideshow-container {
                                    max-width: 1000px;
                                    position: relative;
                                    margin: auto;
                                    }

                                    /* Hide the images by default */
                                    .mySlides {
                                    display: none;
                                    }

                                    /* Next & previous buttons */
                                    .prev, .next {
                                    cursor: pointer;
                                    position: absolute;
                                    top: 50%;
                                    width: auto;
                                    margin-top: -22px;
                                    padding: 16px;
                                    color: white;
                                    font-weight: bold;
                                    font-size: 18px;
                                    transition: 0.6s ease;
                                    border-radius: 0 3px 3px 0;
                                    user-select: none;
                                    }

                                    /* Position the "next button" to the right */
                                    .next {
                                    right: 0;
                                    border-radius: 3px 0 0 3px;
                                    }

                                    /* On hover, add a black background color with a little bit see-through */
                                    .prev:hover, .next:hover {
                                    background-color: rgba(0,0,0,0.8);
                                    }

                                    /* Number text (1/3 etc) */
                                    .numbertext {
                                    color: #f2f2f2;
                                    font-size: 12px;
                                    padding: 8px 12px;
                                    position: absolute;
                                    top: 0;
                                    }

                                    /* The dots/bullets/indicators */
                                    .dot {
                                    cursor: pointer;
                                    height: 15px;
                                    width: 15px;
                                    margin: 0 2px;
                                    background-color: #bbb;
                                    border-radius: 50%;
                                    display: inline-block;
                                    transition: background-color 0.6s ease;
                                    }

                                    .active, .dot:hover {
                                    background-color: #717171;
                                    }

                                    
                                </style>
                                <!-- Slideshow container -->
                                <div class="slideshow-container">

                                <?php 
                                $noi = count($tro['images']);
                                for ($i=0; $i < $noi; $i++) { 
                                    echo 
                                    '<div class="mySlides">
                                        <div class="numbertext">'.($i + 1).' / '.$noi.'</div>
                                            <img src="'.$tro['images'][$i].'" style="width:100%">
                                    </div>'; 
                                }
                                ?>

                                <!-- Next and previous buttons -->
                                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                                </div>
                                <br>

                                <!-- The dots/circles -->
                                <div style="text-align:center">
                                <!-- <span class="dot" onclick="currentSlide(1)"></span> -->
                                <?php
                                for ($i=0; $i < $noi; $i++) { 
                                    echo '<span class="dot" onclick="currentSlide('.($i + 1).')"></span>';
                                }
                                ?>

                                </div>
                                
                                <h4><?php echo $tro['title'] ?></h4>
                                <b>Giá tiền: </b><?php echo number_format($tro['price']) ?>vnđ/tháng - <?php echo $tro['area'] ?>m²<br>
                                
                                <img class="m-1" src="https://static.chotot.com/storage/icons/logos/ad-param/location.svg" width="20px"/>
                                <b>Địa chỉ: </b><?php 
                                $address = $tro['address'];
                                $province = $tro['province'];
                                $district = $tro['district'];    
                                echo $address.', '.$district.', '.$province;
                                ?><br>
                                <img class="m-1" src="https://static.chotot.com/storage/icons/svg/order_timer.svg" width="20px"/><b>Đã đăng tải lúc: </b>
                                <?php
                                date_default_timezone_set('Asia/Bangkok');  
                                $currentDate = date("d-m-Y H:i:s"); 
                                echo $currentDate;
                                ?><br>
                                <img src="https://static.chotot.com/storage/icons/svg/shield.svg" class="m-1"/>Bài đăng đã được kiểm duyệt.
                            </div>
                        </div>
                        <div class="card mt-1 mb-1">
                            <div class="card-header">
                                Mô tả chi tiết
                            </div>
                            <div class="card-body">
                                <p><?php echo $tro['content'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Chủ trọ:
                                <div class="btn border shadow-sm">
                                <?php
                                
                                // echo $userid;
                                echo '<img style="height: 20px;" src="./images/sex/'.$jsonUserData[$userid]['sex'].'.png"/>'.$jsonUserData[$userid]['username'];
                                
                                ?>

                                </div>
                            </div>
                            <div class="card-body">
                                Đặc điểm nhà trọ:<br>
                                <div class="row">
                                    <div class="col-6">
                                        <img style="width:20px;margin-right: 5px" src="https://static.chotot.com/storage/icons/logos/ad-param/ad_type.png"/>Cho thuê
                                    </div>
                                    <div class="col-6">
                                        <img style="width:20px;margin-right: 5px" src="https://static.chotot.com/storage/icons/logos/ad-param/size.png"/>Diện tích:<?php echo $tro['area'] ?>m²
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <img style="width:20px;margin-right: 5px" src="https://static.chotot.com/storage/icons/logos/ad-param/deposit.png"/>Tiền cọc: <?php echo number_format($tro['price']) ?>vnđ
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <i class="fas fa-phone-volume m-1"></i><?php echo $jsonUserData[$userid]['std']; ?>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="text-center">
                                        <?php 
                                        if($tro['status'] == 1) {
                                            echo '<div onclick="datTro('.$index.')" class="btn btn-primary shadow">Thuê ngay</div>';
                                        }else {
                                            echo '<div class="btn btn-danger shadow">Đã hết</div>';

                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                        <style>
                            .scroll-container {
                                width: 100%; /* Set a width for the container */
                                height: 400px; /* Set a fixed height for the container */
                                overflow: auto; /* Add scrollbars when content overflows the container */
                            }
                        </style>
                        <div class="card mt-1 p-2">
                            <h5>Bài đăng khác của <?php echo $jsonUserData[$userid]['username']; ?></h5>
                            <div class="scroll-container">
                                <style>
                                    .two-line-ellipsis {
                                        display: -webkit-box;
                                        -webkit-line-clamp: 1; /* Number of lines to display */
                                        -webkit-box-orient: vertical;
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                    }
                                </style>
                                <?php 
                                $not = count($jsonData);
                                for ($i=0; $i < $not; $i++) { 
                                    if($jsonData[$i]['userid'] == $tro['userid'] && $jsonData[$i]['id'] != $index && $jsonData[$i]['censor'] == 1) {
                                        $title = $jsonData[$i]['title'];
                                        $img = $jsonData[$i]['images'][0];
                                        $price = $jsonData[$i]['price'];
                                        $price = number_format($price);
                                        $area = $jsonData[$i]['area'];
                                        $index = $jsonData[$i]['id'];
                                        echo 
                                        '<div  class="card p-2 m-2">
                                            <img src="'.$img.'"/>
                                            <a href="tro.php?index='.$index.'">
                                                <b class="two-line-ellipsis">'.$title.'</b>
                                                <b>Diện tích: '.$area.'m²</b><br>
                                                <b style="color:#d0021b">'.$price.'/tháng</b>
                                            </a>

                                        </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
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
