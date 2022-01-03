<?php
require 'db/connect.php';
require 'lib/config.php';

require 'lib/data.php';
require 'lib/url.php';
require 'lib/template.php';
require 'lib/users.php';
require 'lb/validation.php';
?>
<?php
db_connect($db);
$models = !empty($_GET['model']) ? $_GET['model'] : 'home';
$act = !empty($_GET['act']) ? $_GET['act'] : 'main';
$pages = "models/{$models}/{$act}.php";
if (file_exists($pages)) {
    require $pages;
} else {
    require 'inc\404.php';
}
?>