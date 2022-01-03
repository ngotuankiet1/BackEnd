<?php

# mảng xác định
$info = array(
    'id' => '1',
    'fullname' => "ngo tuan kiet",
    'Email' => 'ngokiet68@gmail.com',
);

echo "<pre>";
print_r($info);
echo "</pre>";

$info ['phone'] = '0975223547';

echo "<pre>";
print_r($info);
echo "</pre>";

#mảng mặc định
$list_prime = array(2, 3, 5, 7);

echo "<pre>";
print_r($list_prime);
echo "</pre>";

$list_prime [] = 11;

echo "<pre>";
print_r($list_prime);
echo "</pre>";
