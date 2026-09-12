<?php
session_start();

// 1. Sabhi session variables destroy karo
$_SESSION = array();

// 2. Session cookie bhi destroy karo
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// 3. Session彻底 destroy karo
session_destroy();

// 4. Browser ko cache na karne ka command do
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Wed, 11 Jan 1984 05:00:00 GMT"); // Past date

// 5. Redirect with cache busting
header("location: My_Account.php?logout=" . time());
exit;
?>