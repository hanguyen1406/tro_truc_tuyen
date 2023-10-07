<?php
if (isset($_COOKIE['username'])) {
    // Remove the specific variable from the cookie
    setcookie('username', '', time() - 3600, '/'); 
    setcookie('avatar', '', time() + 3600, '/');
    setcookie('id', '', time() + 3600, '/');
    setcookie('role', '', time() + 3600, '/');
    setcookie('idtro', '', time() + 3600, '/');
}
// Send a response with the updated cookie
echo "done";
?>
