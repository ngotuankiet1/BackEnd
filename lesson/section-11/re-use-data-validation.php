<?php
if (isset($_POST['btn-reg'])) {
    $error = array();
    if (empty($_POST['fullname'])) {
        $error['fullname'] = "không được để trống fullname";
    } else {
        $fullname = $_POST['fullname'];
    }
    if (empty($_POST['gender'])) {
        $error['gender'] = "không được để trống gender";
    } else {
        $gender = $_POST['gender'];
    }
    if (empty($_POST['city'])) {
        $error['city'] = "không được để trống city";
    } else {
        $city = $_POST['city'];
    }

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
}
?>

<html>
    <style>
        p{
            color: red;
        }
    </style>
    <body>
        <form action="" method="post">
            Fullname: <input type="text" name="fullname" value="<?php if (!empty($fullname)) echo $fullname; ?>" /> <br> 
            <?php if (!empty($error['fullname'])) echo "<p>{$error['fullname']}</p>"; ?>
            <input <?php if (!empty($gender) && $gender == "male") echo "checked='checked'"; ?>  type="radio" name="gender" value="male" />Nam
            <input <?php if (!empty($gender) && $gender == "female") echo "checked='checked'"; ?> type="radio" name="gender" value="female" />Nữ <br>
            <?php if (!empty($error['gender'])) echo "<p>{$error['gender']}</p>"; ?>
            <select name="city">
                <option value="">--Chọn thành phố--</option>
                <option <?php if (!empty($city) && $city == "bd") echo "selected='selected'"; ?> value="bd">Bình dương</option>
                <option <?php if (!empty($city) && $city == "td") echo "selected='selected'"; ?> value="td">Thủ đức</option>
            </select><br>
            <?php if (!empty($error['city'])) echo "<p>{$error['city']}</p>"; ?>
            <input type="submit" name="btn-reg" value="Register"/>
        </form>
    </body>
</html>

