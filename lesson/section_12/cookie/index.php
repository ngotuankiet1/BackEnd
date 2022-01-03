<?php
ob_start();
session_start();
if(isset($_COOKIE['is_login'])){
    echo "cookie {$_COOKIE['user_name']}";
}
echo '<br><h1>Trang Chủ</h1><br>';
if (!isset($_SESSION['is_login'])) {
    header("Location: login.php");
} else {
    echo $_SESSION['user_name'] . "<br>";
}
?>
<a href="logout.php">Đăng xuất</a>