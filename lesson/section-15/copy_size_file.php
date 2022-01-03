<?php
#copy file
$sourse='uploads/anh2.jpg';
$dest='uploads/anh2-1.jpg';
if(copy($sourse, $dest)){
    echo 'copy thành công';
}
/*---------------------------------------------*/
#size file
//$file_url='uploads/anh2.jpg';
//echo 'size:'.filesize($file_url);

