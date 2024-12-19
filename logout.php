<?php
// Start the session
session_start();

// Destroy the session
session_unset();
session_destroy();

// Delete the cookies by setting their expiration date in the past
setcookie("user_id", "", time() - 3600, "/");
setcookie("name", "", time() - 3600, "/");

// Ensure server-side unset of cookies
unset($_COOKIE['user_id']);
unset($_COOKIE['name']);

// Redirect to the login page
header("Location: login.php");
exit;
?>