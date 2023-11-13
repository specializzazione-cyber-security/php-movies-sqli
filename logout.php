<?php
session_start();

// Clear all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect the user to the login page or home page
header("Location: index.php");
exit;