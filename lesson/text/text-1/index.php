<?php
ob_start();
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
}
?>
<h1>trang chu</h1>
<a href="logout.php">dang xuat</a>

