<?php 
if (isset($_COOKIE['admin'])) { 

} else {
    header("Location: http://127.0.0.1/sign_in");
    // header("Location: http://127.0.0.1/sign_in");
    exit(); // 
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
    <body>
        <div>
            <ul id="nav-tab" style="background-color: aliceblue" class="nav nav-tabs sticky-top p-2">
                <li class="nav-item">
                    <a
                        class="nav-link active"
                        id="Home-tab"
                        data-bs-toggle="tab"
                        href="#Home"
                        role="tab"
                        aria-controls="Home"
                        aria-selected="true"
                        >Kiểm duyệt bài đăng</a
                    >
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="Product-tab"
                        data-bs-toggle="tab"
                        href="#Product"
                        role="tab"
                        aria-controls="Product"
                        aria-selected="false"
                        >Quản lý tài khoản</a
                    >
                </li>
                
                <li
                    style="flex: 1; flex-direction: row-reverse; display: flex"
                    class="nav-item "
                >
                
                <button class="btn shadow" id="user_btn">
                <img style="height: 20px;" src="../images/sex/0.png"/>
                    <div id="name">Admin</div>
                </button>
                
                <div class="context-menu" id="contextMenu">
                    <ul>
                        <li><p href="#" id="signOutBtn">Sign Out</p></li>
                    </ul>
                </div>

                </li>
            </ul>

            <div style="background-color: blue" class="tab-content">
                <div
                    id="Home"
                    class="tab-pane fade show active"
                    role="tabpanel"
                    aria-labelledby="Home-tab"
                >
                    <div class="container">
                        <?php 
                        $filePath = '../tro.json';
                        // Read the existing JSON data from the file
                        $existingData = file_get_contents($filePath);
                        // Decode the JSON data into a PHP array
                        $data = json_decode($existingData, true);

                        date_default_timezone_set('Asia/Bangkok');
                            for ($i = 0; $i < count($data); $i++) {
                                if ($data[$i]['censor'] == 0) {
                                    $title = $data[$i]['title'];
                                    $img = $data[$i]['images'][0];
                                    $price = $data[$i]['price'];
                                    $price = number_format($price);
                                    $address = $data[$i]['address'];
                                    $province = $data[$i]['province'];
                                    $district = $data[$i]['district'];
                                    $currentDate = date("d-m-Y H:i:s"); // Format: YYYY-MM-DD HH:MM:SS
                                    $content = $data[$i]['content'];
                                    $id = $data[$i]['id'];
                                    $status = "Phê duyệt";
                                    $btn_display = "primary";
                                

                                    echo 
                                    '<div class="row">
                                        <div class="col-md-12 mt-2 mb-1">
                                            <div class="card p-1">
                                                <div class="row no-gutters">
                                                    <div class="col-md-3">
                                                        <img width="300" height="170" src="'.$img.'" alt="Image" class="card-img">
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><a class="card-text two-line-ellipsis" target="_blank" href="http://127.0.0.1/tro.php?index='.$i.'">'.$title.'</a></h5>
                                                            <p class="card-text two-line-ellipsis">'.$content.'</p>
                                                            <b>Giá tiền:</b> '.$price.' vnđ<br>
                                                            <b>Địa chỉ:</b> '.$address.', '.$district.', '.$province.'<br>
                                                            <b>Đăng tải lúc:</b> '.$currentDate.'<br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="m-2">
                                                            <div class="text-centers d-flex justify-content-center">
                                                                <div onclick="hello('.$id.')" id="censor" class="btn btn-'.$btn_display.' border shadow-sm">
                                                                    <a target="_blank" style="color:white">
                                                                    '.$status.'
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
                <div
                    id="Product"
                    class="tab-pane fade"
                    role="tabpanel"
                    aria-labelledby="Product-tab"
                >
                    <h3>Quan ly tai khoan</h3>
                    
                </div>
                
            </div>
        </div>
        <div class="row p-2" style="background-color: white;">
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
        <hr>
    
    </body>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./script.js"></script>
</html>
