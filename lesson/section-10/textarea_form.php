<?php
if (isset($_POST['btn_add'])) {
    if (empty($_POST['details'])) {
        echo 'vui lòng thêm thông tin';
    } else {
        $details = $_POST['details'];
        echo $details;
    }
}
?>

<html>
    <body>
        <h1>Thêm Bài Viết</h1>
        <form action="" method="post">
            <textarea name="details" cols="50" rows="15"></textarea> <br> <br>
            <input type="submit" name="btn_add" value="Thêm Bài Viết"/>
        </form>
    </body>
</html>