<?php
ob_start();
session_start();
echo '<h1>Trang Chủ</h1><br>';
if (!isset($_SESSION['is_login'])) {
    header("Location: login.php");
} else {
    echo $_SESSION['user_name'] . "<br>";
}
?>
<a href="logout.php">Đăng xuất</a>