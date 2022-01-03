<?php

ob_start();
session_start();
require 'database/array.php';
require 'lib/data.php';
require 'lb/validation.php';
require 'lib/users.php';
require 'lib/url.php';

?>
<?php

$page = !empty($_GET['page']) ? $_GET['page'] : 'home';
$pages = "pages/{$page}.php";
if (!is_login() && $page != 'login') {
    redirect("?page=login");
} else {
    if (file_exists($pages)) {
        require $pages;
    } else {
        require 'inc/404.php';
    }
}
?>

