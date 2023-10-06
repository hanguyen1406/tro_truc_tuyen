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
                    // window.location.href = "http://127.0.0.1/admin";
<<<<<<< HEAD
                    window.location.href = "http://127.0.0.1/admin";

=======
                    window.location.href = "http://t127.0.0.1/admin";
>>>>>>> bb55ebfef0beb1a50a538d6a86b06f1f7a949f45
                }
                if (data == 0) {
                    // console.log(email.value);
                    swal("Email không tồn tại");
                } else if (data == 1) {
                    swal("Sai mật khẩu");
                } else if (data == 2) {
                    swal("Đăng nhập thành công").then(() => {
<<<<<<< HEAD
                        window.location.href = "http://127.0.0.1/";
=======
                        window.location.href = "http://t127.0.0.1/";
>>>>>>> bb55ebfef0beb1a50a538d6a86b06f1f7a949f45
                        // window.location.href = "http://127.0.0.1";
                    });
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }
});
