<?php

$conn = mysqli_connect('localhost', 'root', '', 'unitop');
if (!$conn) {
    echo 'Không thể kết nối' . mysqli_connect_errno();
    die();
}
//else {
//    echo 'Kết nối thành công';
//}

