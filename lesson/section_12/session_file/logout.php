<?php
ob_start();
session_start();
unset($_SESSION['is_login']);
unset($_SESSION['user_name']);
//session_destroy();
header("Location: login.php");
?>
