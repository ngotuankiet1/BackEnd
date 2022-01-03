<?php

ob_start();
session_start();
setcookie("is_login", "true", time() - 3600);
setcookie("user_name", "Ngô Tuấn Kiệt", time() - 3600);
unset($_SESSION['is_login']);
unset($_SESSION['user_name']);
//session_destroy();
header("Location: login.php");
?>
