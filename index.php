<?php 
$username = '';
if (isset($_COOKIE['username'])) {
    $tab1 = 'active';
    $tab2 = '';
    $tab3 = '';
    $username = $_COOKIE['username'];
    if(isset($_GET['tab'])) {
        $tab = $_GET['tab'];
        switch($tab) {
            case '1': 
                $tab1 = '';
                $tab2 = 'active';
                break;   
            case '2':
                $tab1 = '';
                $tab3 = 'active';
                break;  
        }
    }

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
                    <a
                        class="nav-link <?php echo $tab1 ?>"
                        id="Home-tab"
                        data-bs-toggle="tab"
                        href="#Home"
                        role="tab"
                        aria-controls="Home"
                        aria-selected="true"
                        >Trang chủ</a
                    >
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link <?php echo $tab2 ?>"
                        id="Product-tab"
                        data-bs-toggle="tab"
                        href="#Product"
                        role="tab"
                        aria-controls="Product"
                        aria-selected="false"
                        >Tìm trọ</a
                    >
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link <?php echo $tab3 ?>"
                        id="Contact-tab"
                        data-bs-toggle="tab"
                        href="#Contact"
                        role="tab"
                        aria-controls="Contact"
                        aria-selected="false"
                        >Cho thuê</a
                    >
                    <script>
                        var choThue = document.querySelector("#Contact-tab");
                        choThue.addEventListener("click",() => {
                            if(getCookie('role') == '1') {
                                swal("Lỗi", "Phần này chỉ dành cho người cho thuê")
                                document.querySelector("#Home-tab").click();
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
                        <li><p href="#" id="trocuatoi">phòng trọ của tôi</p></li>
                        <li><p href="#" id="signOutBtn">Đăng xuất</p></li>
                    </ul>
                </div>

                </li>
            </ul>

            <div class="tab-content container">
                <div
                    id="Home"
                    class="tab-pane fade <?php if($tab1 == 'active') echo 'show active'; ?>"
                    role="tabpanel"
                    aria-labelledby="Home-tab"
                >
                    <div style="background-color: #F4FCFF" class="border rounded p-2 mt-2">
						<h3>Hiện đang có tất cả <?php 
                            $filePath = './tro.json';
                            // Read the existing JSON data from the file
                            $existingData = file_get_contents($filePath);
                            // Decode the JSON data into a PHP array
                            $data = json_decode($existingData, true);
                            $cnt = 0;
                            for ($i=0; $i < count($data); $i++) { 
                                if($data[$i]['censor'] == 1) $cnt++;
                            }
                            echo $cnt;
                        ?> phòng trọ:</h3>
                        <div class="d-flex align-items-center">
                            <b class="m-1">Sắp xếp theo:</b>
                            <select class="form-select w-auto mb-1" aria-label="sap xep phong">
                                <option selected>Mặc định</option>
                                <option value="1">Mới đăng</option>
                                <option value="2">Giá giảm dần</option>
                                <option value="3">Giá tăng dần</option>
                            </select>
                        </div>

                        <div class="p-4" id="list_rom">                            
                        <!-- row-cols-1 row-cols-md-3 g-4 -->
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
                            date_default_timezone_set('Asia/Bangkok');
                            for ($i = 0; $i < count($data); $i++) {
                                if ($data[$i]['censor'] == 1) {
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
                                    </div> ';   
                                }
                            }
                            ?>
                        </div>

					</div>
                </div>
                <div
                    id="Product"
                    class="tab-pane fade <?php echo 'show '.$tab2; ?>"
                    role="tabpanel"
                    aria-labelledby="Product-tab"
                >
                    <h3>Tìm trọ</h3>
                    <p>
                        anvfrg
                    </p>
                </div>
                <div
                    id="Contact" 
                    class="tab-pane fade <?php echo 'show '.$tab3; ?>"
                    role="tabpanel"
                    aria-labelledby="Contact-tab"
                >
                    <div class="card mt-1">
                        <div class="card-header">Nhập thông tin trọ:</div>
                        <div class="container mt-4">
                            <div id="form">
                                <div class="form-group">
                                    <label for="title">Tiêu đề:</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                                <div class="form-group">
                                    <label for="price">Giá tiền:</label>
                                    <input placeholder="Ví dụ: 1000000" type="text" class="form-control" id="price" name="price">
                                </div>
                                <div class="form-group mt-1">
                                    <label for="numImages">Nhập số lượng ảnh:</label>
                                    <input type="number" id="numImages" name="numImages" min="1" />
                                    <button type="button" class="btn btn-primary" onclick="createImageInputs()">
                                        Tạo form điền link
                                    </button>

                                    <div id="imageInputs">
                                        <!-- Image input fields will be generated here -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="area">Diện tích:</label>
                                    <input placeholder="Chỉ cần ghi số" type="text" class="form-control" id="area" name="area">
                                </div>
                                <div class="form-group">
                                    <label for="province">Tỉnh/thành:</label>
                                    <input placeholder="Ví dụ: thành phố Hà Nội" type="text" class="form-control" id="province" name="province">
                                </div>
                                <div class="form-group">
                                    <label for="district">Quận/huyện:</label>
                                    <input placeholder="Ví dụ: quận Đống Đa" type="text" class="form-control" id="district" name="district">
                                </div>
                                <div class="form-group">
                                    <label for="address">Số nhà/đường:</label>
                                    <input placeholder="Ví dụ: 175, Tây Sơn..." type="text" class="form-control" id="address" name="address">
                                </div>
                                <div class="form-group">
                                    <label for="content">Nội dung mô tả phòng:</label>
                                    <textarea class="form-control" id="content" name="content" rows="4"></textarea>
                                </div>
                                <div class="text-center">
                                    <button id="submit" class="btn btn-primary m-1">Gửi admin phê duyệt</button>
                                </div>
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
</html>
