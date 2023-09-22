var contextMenu = document.getElementById("contextMenu");
var usernameBtn = document.querySelector("#user_btn");
var signOutBtn = document.getElementById("signOutBtn");

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

// Show the context menu on right-click
usernameBtn.addEventListener("contextmenu", showContextMenu);

// Hide the context menu when clicking outside of it
document.addEventListener("click", hideContextMenu);

// Hide the context menu when clicking the Sign Out button
signOutBtn.addEventListener("click", () => {
    hideContextMenu();
    fetch('./sign_out.php')
    .then(response => response)
    .then(data => {
        window.location.href = "http://trotot.infinityfreeapp.com/sign_in/";
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
