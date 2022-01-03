<?php
session_start();
ob_start();
#dữ liệu
require 'data/pages.php';
require 'data/product.php';
#thư viện
require 'lib/data.php';
require 'lib/url.php';
require 'lib/pages.php';
require 'lib/product.php';
require 'lib/cart.php';
require 'lib/template.php';
require 'lib/number.php';
?>
<?php
$models = !empty($_GET['model']) ? $_GET['model'] : 'home';
$act = !empty($_GET['act']) ? $_GET['act'] : 'main';
$pages = "models/{$models}/{$act}.php";
if (file_exists($pages)) {
    require $pages;
} else {
    require 'inc\404.php';
}
?>