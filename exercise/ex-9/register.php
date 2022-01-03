<?php
require 'validation.php';
if (isset($_POST['btn-res'])) {
    $error = array();
    if (empty($_POST['fullname'])) {
        $error['fullname'] = 'Không được để trống Fullname';
    } else {
        if (!is_fullname($_POST['fullname'])) {
            $error['fullname'] = 'Fullname Không đúng đinh dạng';
        } else {
            $fullname = $_POST['fullname'];
        }
    }
    /* ============================================ */
    if (empty($_POST['username'])) {
        $error['username'] = 'Không được để trống Username';
    } else {
        if (!is_username($_POST['username'])) {
            $error['username'] = 'Username Không đúng đinh dạng';
        } else {
            $username = $_POST['username'];
        }
    }
    /* ============================================ */
    if (empty($_POST['password'])) {
        $error['password'] = 'Không được để trống Password';
    } else {
        if (!is_password($_POST['password'])) {
            $error['password'] = 'Password Không đúng đinh dạng';
        } else {
            $password = md5($_POST['password']);
        }
    }
    /* ============================================ */
    if (empty($_POST['number'])) {
        $error['number'] = 'Không được để trống NumberPhone';
    } else {
        if (!is_number($_POST['number'])) {
            $error['number'] = 'NumberPhone Không đúng đinh dạng';
        } else {
            $number = $_POST['number'];
        }
    }

    if (empty($error)) {
        $info = array(
            'fullname' => $fullname,
            'username' => $username,
            'password' => $password,
            'number_phone' => $number
        );
        echo '<pre>';
        print_r($info);
        echo '</pre>';
    }
}
?>
<html>
    <head>
        <title>Bài tập số 9</title>
    </head>
    <body>
        <form method="POST">
            <label for="fullname">Fullname</label><br>
            <input type="text" name="fullname" id="fullname" value="<?php echo set_value('fullname'); ?>"/> <br>
            <?php echo form_error('fullname') ?>
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>"/> <br>
            <?php echo form_error('username') ?>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" placeholder="kí tự đầu là Hoa"/> <br>
            <?php echo form_error('password') ?>
            <label for="number">NumberPhone</label><br>
            <input type="text" name="number" value="<?php echo set_value('number'); ?>" id="number"/> <br>
            <?php echo form_error('number') ?>
            <input type="submit" name="btn-res" value="Register"/>
        </form>
    </body>
</html>

