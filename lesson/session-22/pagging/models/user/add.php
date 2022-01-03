<?php get_header(); ?>
<?php
if (!empty($_POST['btn_add'])) {
    $error = array();
    $alert = array();
    if (!empty($_POST['fullname'])) {
        $fullname = $_POST['fullname'];
    } else {
        $error['fullname'] = "Không được để trống fullname";
    }
    if (!empty($_POST['username'])) {
        if (!is_username($_POST['username'])) {
            $error['username'] = "Định dang username không chính xác";
        } else {
            $username = $_POST['username'];
        }
    } else {
        $error['username'] = "Không được để trống username";
    }
    if (!empty($_POST['password'])) {
        if (!is_password($_POST['password'])) {
            $error['password'] = "Định dang password không chính xác";
        } else {
            $password = md5($_POST['password']);
        }
    } else {
        $error['password'] = "Không được để trống password";
    }
    if (!empty($_POST['email'])) {
        if (!is_email($_POST['email'])) {
            $error['email'] = "Định dang email không chính xác";
        } else {
            $email = $_POST['email'];
        }
    } else {
        $error['email'] = "Không được để trống email";
    }

    if (!empty($_POST['gender'])) {
        $gender = $_POST['gender'];
    } else {
        $error['gender'] = "Không được để trống gender";
    }

    if (empty($error)) {
//        $sql = "INSERT INTO `tbl_user`(`fullname`,`username`,`password`,`email`,`gender`)"
//                . "VALUES('{$fullname}','{$username }','{$password}','{$email}','{$gender}')";
//        if (mysqli_query($conn, $sql)) {
//            $alert['success'] = "Thêm thành công";
//        } else {
//            echo 'Thêm không thành công' . mysqli_error($conn);
//        }
        $data = array(
            'fullname' => $fullname,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'gender' => $gender,
        );
        $a = db_insert("tbl_user", $data);
        if(isset($a)){
            $alert['success'] ="Thêm mới thành công!";
        }
        //echo $a;
    }
}
?>
<style>
    .succsess{
        color: red;
    }
</style>
<div id="content">
    <p>Thêm thành viên</p>
    <?php
    if (!empty($alert['success'])) {
        ?>
        <p class="succsess"><?php echo $alert['success']; ?></p>
    <?php } ?>
    <form method="POST">
        <label for="fullname">Fullname</label><br>
        <input type="text" id="fullname" name="fullname" value="<?php if (!empty($fullname)) echo set_value('fullname'); ?>"/><br>
        <?php echo form_error('fullname'); ?>
        <label for="username">Username</label><br>
        <input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" /><br>
        <?php echo form_error('username'); ?>
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password"/><br>
        <?php echo form_error('password'); ?>
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email"/><br>
        <?php echo form_error('email'); ?>
        <label for="gender">Gender</label><br>
        <select id="gender" name="gender">
            <option value="">--Chọn giới tính--</option>
            <option value="male">male</option>
            <option value="female">female</option>
        </select>
        <?php echo form_error('gender'); ?>
        <br><br>
        <input type="submit" name="btn_add" value="Thêm">
    </form>
</div>
<?php get_footer(); ?>

