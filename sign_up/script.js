var email = document.querySelector("#email");
var password = document.querySelector("#password");
var sign_up = document.querySelector("#sign-up");
var re_password = document.querySelector("#re_password");
var username = document.querySelector("#username");
var dangTk = document.querySelector("#role");
var sex = document.querySelector("#sex");
var sdt = document.querySelector("#sdt");
sign_up.addEventListener("click", () => {
    // console.log(dangTk.value);
    if (email.value == "" || password.value == "" || username.value == "") {
        swal("Lỗi", "Bạn nhập thiếu thông tin đăng ký");
    } else {
        if (password.value != re_password.value) {
            swal("Lỗi", "Mật khẩu không khớp!");
        } else {
            var user = {
                email: email.value,
                password: password.value,
                username: username.value,
                role: dangTk.value,
                sex: sex.value,
                std: sdt.value,
                idtro: -1,
            };
            // console.log(user);
            fetch("sign_up.php", {
                method: "POST",
                body: JSON.stringify(user), // Convert the JavaScript object to a JSON string
                headers: {
                    "Content-Type": "application/json", // Set the content type to JSON
                },
            })
                .then((response) => response.text())
                .then((data) => {
                    // console.log(data);
                    // You can handle the response as needed
                    if (data == "1") {
                        swal("Đăng ký thành công, trở về trang chủ").then(
                            () => {
<<<<<<< HEAD
                                window.location.href = "http://127.0.0.1/";
=======
                                window.location.href = "http://t127.0.0.1/";
>>>>>>> bb55ebfef0beb1a50a538d6a86b06f1f7a949f45
                                // window.location.href = "http://127.0.0.1";
                            }
                        );
                    } else {
                        swal(
                            "Lỗi",
                            "Email đã tồn tại, vui lòng nhập email khác"
                        );
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }
    }
});
