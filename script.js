var contextMenu = document.getElementById("contextMenu");
var usernameBtn = document.querySelector("#user_btn");
var signOutBtn = document.getElementById("signOutBtn");
var menuOpen = false;
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
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        // Check if this is the cookie we're looking for
        if (cookie.startsWith(cookieName + '=')) {
            return cookie.substring(cookieName.length + 1);
        }
    }
    // If the cookie is not found, return null
    return null;
}

// Show the context menu on right-click
usernameBtn.addEventListener("click", showContextMenu);

function createImageInputs() {
    const numImages = parseInt(
        document.getElementById("numImages").value
    );

    const imageInputsContainer =
        document.getElementById("imageInputs");
    imageInputsContainer.innerHTML = ""; // Clear previous inputs

    for (let i = 1; i <= numImages; i++) {
        const input = document.createElement("input");
        input.type = "text";
        input.name = "image" + i;
        input.placeholder = "Enter image link " + i;
        input.className = "form-control m-1";
        imageInputsContainer.appendChild(input);
    }
}

// Hide the context menu when clicking outside of it
document.querySelector(".tab-content").addEventListener("click", () => {
    hideContextMenu();
});

// Hide the context menu when clicking the Sign Out button
signOutBtn.addEventListener("click", () => {
    hideContextMenu();
    fetch("./sign_out.php")
        .then((response) => response)
        .then((data) => {
            // window.location.href = "http://trotot.infinityfreeapp.com/sign_in/";
            window.location.href = "http://127.0.0.1/sign_in/";
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});
