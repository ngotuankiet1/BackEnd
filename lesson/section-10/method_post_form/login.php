<?php

echo "<pre>";
print_r($_POST);
echo "</pre>";

$usename=$_POST['usename'];
$password=$_POST['password'];
echo "$usename - $password";
