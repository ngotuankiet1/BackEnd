<?php
require 'lib/data.php';
if (isset($_FILES['file'])) {
    show_array($_FILES);
    $upload_dir = 'uploads/';
    $upload_file = $upload_dir . $_FILES['file']['name'];
    if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
        echo "<a href='{$upload_file}'>Download:{$_FILES['file']['name']}</a>";
    } else {
        echo 'Upload file không thanh công';
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
