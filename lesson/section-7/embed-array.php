<?php
$list_prime = array(2, 3, 5, 7);
//==================================================
$list_users = array(
    1 => array(
        'id' => 1,
        'fullname' => 'ngô tuấn kiệt',
        'Email' => 'ngokiet68@gmail.com',
    ),
    2 => array(
        'id' => 2,
        'fullname' => 'Dương văn Lâm',
        'Email' => 'ngokiet69@gmail.com',
    )
);

//=============================================
//$list_user = array(
//    1 => array(
//        'id' => 1,
//        'fullname' => 'ngô tuấn kiệt',
//        'Email' => 'ngokiet68@gmail.com',
//    ),
//    2 => array(
//        'id' => 2,
//        'fullname' => 'Dương văn Lâm',
//        'Email' => 'ngokiet69@gmail.com',
//    )
//);
//===============================================
function show_array($data) {
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}
?>
<html>
    <head>
        <title>nhúng dữ liệu mảng vào html</title>
    </head>
    <body>
        <h2>danh sách số nguyên tố</h2>
        <table border="1">
            <thead>
                <tr>
                    <td width="50">stt</td>
                    <td width="200">số nguyên tố</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $temp = 0;
                foreach ($list_prime as $item) {
                    $temp++;
                    ?>
                    <tr>
                        <td><?php echo $temp; ?></td>
                        <td><?php echo $item; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <!--==================================================-->
        <h2>danh sách users</h2>
        <table border="1">
            <thead>
                <tr>
                    <td width="50">id</td>
                    <td width="200">fullname</td>
                    <td width="200">Email</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $temp = 0;
                foreach ($list_users as $users) {
                    show_array($users);
                    $temp++;
                    ?>
                    <tr>
                        <td><?php echo $users["id"]; ?></td>
                        <td><?php echo $users["fullname"]; ?></td>
                        <td><?php echo $users["Email"]; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <!--==================================================-->
        <h2>kiểm tra mảng</h2>
        <?php
        if (!empty($list_user)) {
            ?>
            <table border = "1">
                <thead>
                    <tr>
                        <td width = "50">id</td>
                        <td width = "200">fullname</td>
                        <td width = "200">Email</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $temp = 0;
                    foreach ($list_user as $user) {
                        show_array($users);
                        $temp++;
                        ?>
                        <tr>
                            <td><?php echo $user["id"]; ?></td>
                            <td><?php echo $user["fullname"]; ?></td>
                            <td><?php echo $user["Email"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            ?>
            <p>mảng rỗng</p>
            <?php
        }
        ?>
    </body>
</html>
