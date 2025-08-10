<?php
session_start();
include "db.php";

$_SESSION['loginmsg'] = "Logged Out Successfully";

// Clear the login session
unset($_SESSION['login']);

// Redirect everyone to index page
header('Location: index.php');
exit();
?>
