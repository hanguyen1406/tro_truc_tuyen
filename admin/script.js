var contextMenu = document.getElementById("contextMenu");
var usernameBtn = document.querySelector("#user_btn");
var signOutBtn = document.getElementById("signOutBtn");
var submit = document.querySelector("#submit");
// var censor = document.querySelectorAll("#censor");
function showContextMenu(event) {
    event.preventDefault();
    contextMenu.style.right = 10 + "px";
    contextMenu.style.top = 52 + "px";
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

function hello(index) {
    // alert(index);
    fetch("phe_duyet.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ index: index }),
    })
        .then((response) => response.text())
        .then((data) => {
            if (data == 1) {
                // window.location.href = "http://127.0.0.1/admin";
                swal("Phê duyệt thành công").then(() => {
                    window.location.href =
                        "http://trotot.infinityfreeapp.com/admin";
                });
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

// Show the context menu on right-click
usernameBtn.addEventListener("click", showContextMenu);

// Hide the context menu when clicking outside of it
document
    .querySelector(".tab-content")
    .addEventListener("click", hideContextMenu);

// Hide the context menu when clicking the Sign Out button
signOutBtn.addEventListener("click", () => {
    hideContextMenu();
    fetch("./sign_out.php")
        .then((response) => response)
        .then((data) => {
            window.location.href = "http://trotot.infinityfreeapp.com/";
            // window.location.href = "http://127.0.0.1/";
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});
