<?php
require 'lib/data.php';
require 'lib/validation.php';
if (isset($_POST['btn-submit'])) {
    $error = array();
    if (empty($_POST['post_title'])) {
        $error['post_title'] = 'Không được để trống tiêu dề';
    }
    if (empty($_POST['detail_post'])) {
        $error['detail_post'] = 'Không được để trống chi tiết bài viết';
    }

    $post_title = $_POST['post_title'];
    $detail_post = $_POST['detail_post'];
    $description = $_POST['description'];
    $file_dir = 'uploads/';
    $upload_file = $file_dir . $_FILES['file']['name'];
    $type_allow = array('jpg', 'png', 'gif');
    $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    if (!in_array(strtolower($type), $type_allow)) {
        echo 'file không phải đuôi mở rộng png,jpg,gif,jpeg';
    } else {
        if ($_FILES['file']['size'] > 20971520) {
            echo 'size ảnh phải <= 20mb';
        }
        //Kiểm tra tên file có giống trong server không
        if (file_exists($upload_file)) {
            $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
            $new_file_name = $file_name . ' -copy.';
            $new_upload_file = $file_dir . $new_file_name . $type;
            $k = 1;
            while (file_exists($new_upload_file)) {
                $new_file_name = $file_name . " -copy({$k}).";
                $k++;
                $new_upload_file = $file_dir . $new_file_name . $type;
            }
            $upload_file = $new_upload_file;
        }
    }

    if (empty($error)) {
        echo'<strong>Tiêu đề bài viết: </strong>' . $post_title . '<br>';
        echo'<strong>Miêu tả ngắn bài viết: </strong>' . $description . '<br>';
        echo'<strong>Chi tiết bài viết:</strong>' . $detail_post . '<br>';
        if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
            echo '<strong>Ảnh đại diện :</strong>' . '<br>' . "<img src='$upload_file'/>";
        } else {
            echo 'nhap khong thanh cong';
        }
    }
}
?>
<html>
    <head>
        <title>bt</title>
        <script src="ckeditor/ckeditor.js" type="text/javascript"></script>
        <link href="pubbic/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <link href="pubbic/style.css" rel="stylesheet" type="text/css"/>
    <body>
        <div id="wrapper">
            <h1>Nhập thông tin bài viết</h1>
            <form enctype="multipart/form-data" method="POST">
                <label for="post_title">Tiêu đề bài viết</label><br>
                <input type="text" name="post_title" id="post_title" value="<?php echo set_value('post_title'); ?>"/> <br><br>
                <?php echo form_error('post_title'); ?>
                <label for="description">Mô tả ngắn</label><br>
                <textarea name="description" id="description" rows="5" cols="30"></textarea><br><br>
                <label>Chi tiết bài viết</label><br>
                <textarea class="ckeditor" name="detail_post"></textarea><br><br>
                <?php echo form_error('detail_post'); ?>
                <label>Ảnh đại diện</label><br>
                <input type="file" name="file"/><br><br>
                <input type="submit" name="btn-submit" value="Nhập"/>       
            </form>
        </div>
    </body>
</html>
