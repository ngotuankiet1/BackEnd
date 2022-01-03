<?php

//Xóa file trong hệ thống
$file_url = 'uploads/anh2.jpg';
if (@unlink($file_url)) {
    echo "Xóa {$file_url} thành công";
} else {
    echo "File {$file_url} không tông tại trên hệ thống";
}

