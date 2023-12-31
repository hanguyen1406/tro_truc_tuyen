var contextMenu = document.getElementById("contextMenu");
var usernameBtn = document.querySelector("#user_btn");
var signOutBtn = document.getElementById("signOutBtn");
var submit = document.querySelector("#submit");
// Function to display the context menu at the mouse position
function showContextMenu(event) {
    event.preventDefault();
    contextMenu.style.right = 10 + "px";
    contextMenu.style.top = 52 + "px"; // Adjust the top position
    contextMenu.style.display = "block";
}
// Function to hide the context menu
function hideContextMenu() {
    contextMenu.style.display = "none";
}
function getCookie(cookieName) {
    const cookies = document.cookie.split(";");
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        // Check if this is the cookie we're looking for
        if (cookie.startsWith(cookieName + "=")) {
            return cookie.substring(cookieName.length + 1);
        }
    }
    // If the cookie is not found, return null
    return null;
}

// Show the context menu on right-click
usernameBtn.addEventListener("click", showContextMenu);

function createImageInputs() {
    const numImages = parseInt(document.getElementById("numImages").value);

    const imageInputsContainer = document.getElementById("imageInputs");
    imageInputsContainer.innerHTML = ""; // Clear previous inputs

    for (let i = 1; i <= numImages; i++) {
        const input = document.createElement("input");
        input.type = "text";
        input.name = "image";
        input.placeholder = "Dán link ảnh " + i;
        input.className = "form-control m-1";
        imageInputsContainer.appendChild(input);
    }
}
submit.addEventListener("click", () => {
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
        fetch("them_tro.php", {
            method: "POST",
            body: JSON.stringify(tro), // Convert the JavaScript object to a JSON string
            headers: {
                "Content-Type": "application/json", // Set the content type to JSON
            },
        })
            .then((response) => response.text())
            .then(async (data) => {
                await swal(
                    "Đăng bài thành công, admin sẽ sớm kiểm duyệt bài viết của bạn"
                );
                // window.location.href = "http://trotot.infinityfreeapp.com";
                window.location.href =
                    "http://trotot.infinityfreeapp.com/?tab=2";
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }
});

document.querySelector("#huy").addEventListener("click", () => {
    fetch("huy.php")
        .then((response) => response.text()) // Parse the response as JSON
        .then(async (data) => {
            await swal(data);
            window.location.href = "http://trotot.infinityfreeapp.com?tab=4";
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});

document
    .querySelector(".tab-content")
    .addEventListener("click", hideContextMenu);

function datTro(index) {
    fetch("dat_tro.php", {
        method: "POST",
        body: JSON.stringify({ index: index }), // Convert the JavaScript object to a JSON string
        headers: {
            "Content-Type": "application/json", // Set the content type to JSON
        },
    })
        .then((response) => response.text())
        .then(async (data) => {
            if (data == "1") {
                await swal("Đặt trọ thành công");
                window.location.href = `http://trotot.infinityfreeapp.com/tro.php?index=${index}`;
            } else if ((data = "2")) {
                swal("Lỗi", "Chủ trọ không thể đặt trọ");
            } else {
                swal("Lỗi", "Bạn chỉ được đặt duy nhất 1 phòng trọ");
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

signOutBtn.addEventListener("click", () => {
    hideContextMenu();
    fetch("./sign_out.php")
        .then((response) => response)
        .then((data) => {
            window.location.href = "http://trotot.infinityfreeapp.com/sign_in/";
            // window.location.href = "http://trotot.infinityfreeapp.com/sign_in/";
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});
