var email = document.querySelector("#email");
var password = document.querySelector("#password");

document.querySelector("#sign_in").addEventListener("click", () => {
    var user = { email: email.value, password: password.value };
    if (user.email == "" || user.password == "") {
        swal("Nhập thiếu thông tin đăng nhập");
    } else {
        fetch("login.php", {
            method: "POST",
            body: JSON.stringify(user),
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.text())
            .then((data) => {
                // console.log(data);
                if (data == -1) {
                    // window.location.href = "http://trotot.infinityfreeapp.com/admin";
                    window.location.href =
                        "http://trotot.infinityfreeapp.com/admin";
                }
                if (data == 0) {
                    // console.log(email.value);
                    swal("Email không tồn tại");
                } else if (data == 1) {
                    swal("Sai mật khẩu");
                } else if (data == 2) {
                    swal("Đăng nhập thành công").then(() => {
                        window.location.href =
                            "http://trotot.infinityfreeapp.com/";
                        // window.location.href = "http://trotot.infinityfreeapp.com";
                    });
                } else if (data == 3) {
                    swal("Tài khoản đã bị cấm!");
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }
});
