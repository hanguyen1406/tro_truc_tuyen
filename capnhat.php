<?php

if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    if (isset($_GET['index'])) {
        $index = $_GET['index'];
    }
    // Specify the path to your JSON file
    $jsonFilePathTro = './tro.json';
    
    $jsonContents = file_get_contents($jsonFilePathTro);
    $jsonData = json_decode($jsonContents, true);

    $tro = $jsonData[$index];
    $userid = $tro['userid'];
    
    
} else {
    header("Location: http://trotot.infinityfreeapp.com/sign_in");
    // header("Location: http://trotot.infinityfreeapp.com/sign_in");
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
                    <!-- http://trotot.infinityfreeapp.com -->
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
                        href="http://trotot.infinityfreeapp.com?tab=2"
                        >Cho thuê</a
                    >
                
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="trocuatoi-tab"
                        href="http://trotot.infinityfreeapp.com?tab=3"
                        >Trọ của tôi</a>
                    
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
                        <li><p href="#" id="signOutBtn">Đăng xuất</p></li>
                    </ul>
                </div>

                </li>
            </ul>

            <div class="tab-content container">
            <div class="card mt-1">
                <div class="card-header">Nhập thông tin trọ:</div>
                    <div class="container mt-4">
                        <div id="form">
                            <div class="form-group">
                                <label for="title">Tiêu đề:</label>
                                <input value="<?php echo $tro['title'] ?>" type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="price">Giá tiền:</label>
                                <input value="<?php echo $tro['price'] ?>" placeholder="Ví dụ: 1000000" type="text" class="form-control" id="price" name="price">
                            </div>
                            <div class="form-group mt-1">
                                <label for="numImages">Nhập số lượng ảnh:</label>
                                <input value="<?php echo count($tro['images']) ?>" type="number" id="numImages" name="numImages" min="1" />
                                <button type="button" class="btn btn-primary" onclick="createImageInputs()">
                                        Tạo form điền link
                                </button>
                                <div id="imageInputs">
                                    <!-- Image input fields will be generated here -->
                                    <?php 
                                    for ($i=0; $i < count($tro['images']); $i++) { 
                                        echo '<input value="'.$tro['images'][$i].'" type="text" class="form-control" name="image">';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="area">Diện tích:</label>
                                <input value="<?php echo $tro['area'] ?>" placeholder="Chỉ cần ghi số" type="text" class="form-control" id="area" name="area">
                            </div>
                            <div class="form-group">
                                <label for="province">Tỉnh/thành:</label>
                                <input value="<?php echo $tro['province'] ?>" placeholder="Ví dụ: thành phố Hà Nội" type="text" class="form-control" id="province" name="province">
                            </div>
                            <div class="form-group">
                                <label for="district">Quận/huyện:</label>
                                <input value="<?php echo $tro['district'] ?>" placeholder="Ví dụ: quận Đống Đa" type="text" class="form-control" id="district" name="district">
                            </div>
                            <div class="form-group">
                                <label for="address">Số nhà/đường:</label>
                                <input value="<?php echo $tro['address'] ?>" placeholder="Ví dụ: 175, Tây Sơn..." type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="form-group">
                                <label for="content">Nội dung mô tả phòng:</label>
                                <textarea class="form-control" id="content" name="content" rows="4"><?php echo $tro['content'] ?></textarea>
                            </div>
                            <div class="text-center">
                                <button id="update" class="btn btn-primary m-1">Cập nhật thông tin</button>
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
        // console.log(</?php echo $index; ?>);
        document.querySelector('#update').addEventListener("click", () => {
        // id, time, user id
        var images = [];
        document.querySelectorAll('input[name="image"]').forEach((img) => {
            images.push(img.value);
        });

        var tro = {
            censor: 0,
            title: document.querySelector('input[name="title"]').value,
            price: document.querySelector('input[name="price"]').value,
            status: 1,
            images: images,
            area: document.querySelector('input[name="area"]').value,
            province: document.querySelector('input[name="province"]').value,
            district: document.querySelector('input[name="district"]').value,
            address: document.querySelector('input[name="address"]').value,
            content: document.querySelector('textarea[name="content"]').value,
        };
        // console.log(submit.innerHTML);
        if (
            tro.title === "" ||
            tro.price === "" ||
            tro.area === "" ||
            tro.province === "" ||
            tro.district === "" ||
            tro.address === "" ||
            tro.content === ""
        ) {
            swal("Lỗi", "Nhập thiếu thông tin");
        } else {
            fetch("update.php", {
                method: "POST",
                body: JSON.stringify({tro: tro, index: <?php echo $index; ?>}),
                headers: {
                    "Content-Type": "application/json", // Set the content type to JSON
                },
            })
                .then((response) => response.text())
                .then(async (data) => {
                    await swal(data);
                    // window.location.href = "http://trotot.infinityfreeapp.com";
                    window.location.href = "http://trotot.infinityfreeapp.com/?tab=3";
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }
    });
    </script>
                                    
    
</html>
