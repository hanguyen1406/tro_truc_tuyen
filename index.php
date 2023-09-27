<?php 
$username = '';
if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    
} else {
    // header("Location: http://trotot.infinityfreeapp.com/sign_in");
    header("Location: http://127.0.0.1/sign_in");
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

        </style>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <title>Bootstrap 5.3 Example</title>
    </head>
    <body style="background-image: url('./images/bg.png'); padding: 15px">
        <div class="container">
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
            <ul style="background-color: aliceblue" class="nav nav-tabs sticky-top p-2 rounded">
                <li class="nav-item">
                    <a
                        class="nav-link active"
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
                        class="nav-link"
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
                        class="nav-link"
                        id="Contact-tab"
                        data-bs-toggle="tab"
                        href="#Contact"
                        role="tab"
                        aria-controls="Contact"
                        aria-selected="false"
                        >Cho thuê</a
                    >
                </li>
                <li
                    style="flex: 1; flex-direction: row-reverse; display: flex"
                    class="nav-item"
                >
                
                <button class="btn btn-secondary" id="user_btn">
                <img style="height: 30px" src="../images/sex/<?php
                    $avatar = $_COOKIE['avatar'];
                    echo $avatar;
                ?>"/>
                    <?php echo $username; ?>
                </button>
                
                <div class="context-menu" id="contextMenu">
                    <ul>
                        <li><p href="#" id="signOutBtn">Sign Out</p></li>
                    </ul>
                </div>

                </li>
            </ul>

            <div class="tab-content">
                <div
                    id="Home"
                    class="tab-pane fade show active"
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
                            echo $data['count'];
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
                            for ($i = 0; $i < $data['count']; $i++) {
                                $title = $data['data'][$i]['title'];
                                $img = $data['data'][$i]['images'][0];
                                $price = $data['data'][$i]['price'];
                                $price = number_format($price);
                                $address = $data['data'][$i]['address'];
                                $province = $data['data'][$i]['province'];
                                $district = $data['data'][$i]['district'];
                                $currentDate = date("Y-m-d H:i:s"); // Format: YYYY-MM-DD HH:MM:SS
                                $status = $data['data'][$i]['status'];
                                echo 
                                '<div class="row">
                                    <div class="col-md-10 mb-3">
                                        <div class="card p-1">
                                            <div class="row no-gutters">
                                                <div class="col-md-4">
                                                    <img width="300" height="200" src="../images/'.$img.'" alt="Image" class="card-img">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title">'.($i + 1).'. '.$title.'</h5>
                                                        <p class="card-text two-line-ellipsis">Some example text for Card 1. You can add more content here. Some example text for Card 1. You can add more content here.</p>
                                                        <b>Giá tiền:</b> '.$price.' vnđ<br>
                                                        <b>Địa chỉ:</b> '.$address.', '.$district.', '.$province.'<br>
                                                        <b>Đăng tải lúc:</b> '.$currentDate.'<br>
                                                        <b>Trạng thái:</b> '.$status.'
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> ';   
                                
                            }
                            ?>
                        </div>

					</div>
                </div>
                <div
                    id="Product"
                    class="tab-pane fade"
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
                    class="tab-pane fade"
                    role="tabpanel"
                    aria-labelledby="Contact-tab"
                >
                    <h3>Cho thuê</h3>
                    <p>
                        
                    </p>
                </div>
            </div>
        </div>
    </body>
    <script src="./script.js"></script>
</html>
