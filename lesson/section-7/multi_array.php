<?php

$info = array(
    1 => array(
        'id' => 1,
        'fullname' => 'ngô tuấn kiệt',
        'Email' => 'ngokiet68@gmail.com',
    ),
    2 => array(
        'id' => 2,
        'fullname' => 'Dương văn Lâm',
        'Email' => 'ngokiet69@gmail.com',
    ),
);

echo "<pre>";
print_r($info);
echo "</pre>";

#thêm thông tin
#C1
//$info [3] = array(
//    'id' => 3,
//    'fullname' => 'lê tấn tài',
//    'Email' => 'ngokiet70@gmail.com',
//);
#C2
$info[3]['id'] = 3;
$info[3]['fullname'] = 'lê tấn tài';
$info[3]['Email'] = 'ngokiet70@gmail.com';

echo "<pre>";
print_r($info);
echo "</pre>";

#lấy thông tin mảng
#C1
$list_user = $info[3];

echo "<pre>";
print_r($list_user);
echo "</pre>";

#C2
echo $list_user['fullname'];
//echo"<br>";
//echo $info[3]['Email'];



