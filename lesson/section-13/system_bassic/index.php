<?php require 'inc/header.php'; ?>

<?php

$page = !empty($_GET['page']) ? $_GET['page'] : 'home';
$path = "pages/{$page}.php";
if (file_exists($path)) {
    require $path;
} else {
    require 'inc/404.php';
}
?>

<?php require 'inc/footer.php'; ?>