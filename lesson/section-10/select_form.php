<?php
if (isset($_POST['btn_order'])) {

//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";

    if (empty($_POST['pay'])) {
        echo 'vui lòng chọn hình thức thanh toán';
    } else {
        $pay = $_POST['pay'];
        echo $pay;
    }
}
?>

<html>
    <body>
        <form action="" method="post">
            <label>Hình thức thanh toán</label> <br>
            <select name="pay">
                <option value="">--Chọn hình thức thanh toán--</option>
                <option value="cod">Thành toán tại nhà</option>
                <option value="banking">Thành toán quá thẻ tín dụng</option>
            </select>
            <input type="submit" name="btn_order" value="Đặt hàng"/>
        </form>
    </body>
</html>

