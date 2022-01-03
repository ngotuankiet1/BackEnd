<?php
if (isset($_POST['btn-reg'])) {

    $show_gender = array(
        "male" => "nam",
        "female" => "nu",
    );

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    if (empty($_POST['gender'])) {
        echo 'không có giá trị';
    } else {
        $gender = $_POST['gender'];
        echo $show_gender[$gender];
    }
}
?>

<html>
    <body>
        <form action="" method="post">
            <input type="radio" name="gender" checked="checked" value="male" id="male">
            <label for="male">Nam</label>  <br>
            <input type="radio" name="gender" value="female" > 
            <label for="female">Nữ</label> <br>
            <input type="submit" name="btn-reg" value="Register"/>
        </form>
    </body>
</html>
