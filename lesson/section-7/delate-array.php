<?php

#xóa mảng
$info = array(
    'id' => '1',
    'fullname' => "ngo tuan hung",
    'Email' => 'ngokiet68@gmail.com',
);

unset($info);

//echo "<pre>";
//print_r($info);
//echo "</pre>";
#xóa mảng 1 chiều
$info = array(
    'id' => '1',
    'fullname' => "ngo tuan hung",
    'Email' => 'ngokiet68@gmail.com',
);

unset($info['id']);

//echo "<pre>";
//print_r($info);
//echo "</pre>";
#xóa mảng nhiều chiều
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

unset($info[2]['id']);
//unset($info[2]);

$info[2]['fullname'] = 'ntk';

echo "<pre>";
print_r($info);
echo "</pre>";
