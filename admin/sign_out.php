<?php
if (isset($_COOKIE['username'])) {
    setcookie('admin', '', time() - 3600, '/'); 
}

echo "done";
?>
