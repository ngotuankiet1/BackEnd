<?php
require 'lib/data.php';
if (isset($_FILES['file'])) {
    $error = array();
    $file_dir = 'uploads/';
    $file_upload = $file_dir . $_FILES['file']['name'];
    //Kiểm tra đuôi file ảnh
    $type_allow = array('png', 'jpg', 'gif', 'jpeg');
    $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    if (!in_array(strtolower($type), $type_allow)) {
        $error['type'] = 'file không phải đuôi mở rộng png,jpg,gif,jpeg';
    } else {
        //Kiểm tra size ảnh(1mb = 1.048.576 bytes => 20mb =20.971.520 bytes)
        if ($_FILES['file']['size'] > 20971520) {
            $error['file_size'] = "size ảnh phải <= 20mb";
        }
        //Kiểm tra tên file có giống trong server không
        if (file_exists($file_upload)) {
            $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
            $new_file_name = $file_name . ' -copy.';
            $new_upload_file = $file_dir . $new_file_name . $type;
            $k = 1;
            while (file_exists($new_upload_file)) {
                $new_file_name = $file_name . " -copy({$k}).";
                $k++;
                $new_upload_file = $file_dir . $new_file_name . $type;
            }
            $file_upload = $new_upload_file;
        }
    }

    if (!empty($error)) {
        show_array($error);
    } else {
        show_array($_FILES);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $file_upload)) {
            echo "<img src='{$file_upload}'>.<br>";
            echo "<a href='{$file_upload}'>{$_FILES['file']['name']}</a>";
        }
    }
}
?>
<html>
    <head>
        <title>upload file</title>
    </head>
    <body>
        <h1>UPLOAD FILE</h1>
        <form enctype="multipart/form-data" action="" method="POST">
            <input type="file" name="file"> <br><br>
            <input type="submit" value="Upload file">
        </form>
    </body>
</html>