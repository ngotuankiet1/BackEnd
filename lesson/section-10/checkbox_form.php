<?php
if (isset($_POST['btn-reg'])) {
    if (isset($_POST['rules'])) {
        $gender = $_POST['rules'];
        echo $gender;
    } else {
        echo "vui lòng xác nhận trước khi đăng kí";
    }
}
?>

<html>
    <body>
        <h1>ĐĂNG KÍ</h1>
        <form action="" method="post">
            <p style="width: 400px;height: 200px;overflow: scroll">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
            <input  type="checkbox" name="rules" value="yes" id="rules"> 
            <label for="rules"> Đồng Ý</label> <br> <br>
            <input type="submit" name="btn-reg" value="Register"/>
        </form>
    </body>
</html>

