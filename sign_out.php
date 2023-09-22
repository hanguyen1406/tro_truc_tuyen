<?php
if (isset($_COOKIE['username'])) {
    // Remove the specific variable from the cookie
    setcookie('username', '', time() - 3600, '/'); // Set expiration in the past
}
// Send a response with the updated cookie
echo "done";
?>
