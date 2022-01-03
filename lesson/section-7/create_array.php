<?php

#Mảng rỗng
$error_1 = array();
#Mảng mặc định
$info_odd = array(1, 3, 5);

#Mảng xác định
$info_user = array('id' => 1,
    'fullname' => 'Ngô Tuấn Kiệt',
    'Email' => 'ngokiet68@gmail.com'
);
#tạo giá trị mảng
$error_2 ['usename'] = "không được để trống tên";

//==============================
//==============================
echo "<pre>";
print_r($error_2);
echo "</pre>";
?>