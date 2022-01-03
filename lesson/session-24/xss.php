<?php
require 'data/connect.php';
//setcookie("user_Login", "admin", time() + 3600);
//setcookie("is_Login", true, time() + 3600);
if (isset($_POST['btn_sent'])) {
    $username = $_POST['username']; //Chuẩn hóa dữ liệu username
    $content = htmlentities($_POST['content']);

    $sql = "INSERT INTO `xss` (`username`,`comment`) VALUES ('$username','$content')";
    if (!empty($username) && !empty($content)) {
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo mysqli_error($conn);
        } else {
            echo 'Nhập Thành Công';
        }
    }
}
$sql = "select * from `xss`";
$result = mysqli_query($conn, $sql);
$list_comment = array();
while ($row = mysqli_fetch_assoc($result)) {
    $list_comment[] = $row;
}
?>
<html>
    <head>
        <title>Chống mã lệnh đọc trong comment</title>
    </head>
    <body>
        <h2>Bình luận</h2>
        <form method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" /><br><br>
            <label for="content">Content:</label><br>
            <textarea id="content" rows="5" cols="30" name="content"></textarea><br><br>
            <input type="submit" name="btn_sent" value="Sent"/>
        </form>
        <?php foreach ($list_comment as $item) { ?>
            <p> <Strong><?php echo $item['username'] ?></Strong>: <?php echo $item['comment'] ?></p>
        <?php } ?>
    </body>
</html> 