<?php
require 'lib/template.php';
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