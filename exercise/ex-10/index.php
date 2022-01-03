<?php
require 'lb/validation.php';
require 'function.php';
if (isset($_POST['btn-login'])) {
    $error = array();
    if (empty($_POST['username'])) {
        $error['username'] = "Không để trống username";
    } else {
        if (!is_username($_POST['username'])) {
            $error['username'] = 'kí tự phải từ 6 đến 32';
        } else {
            $username = $_POST['username'];
        }
    }

    if (empty($_POST['password'])) {
        $error['password'] = "Không để trống password";
    } else {
        if (!is_password($_POST['password'])) {
            $error['password'] = 'password không đúng đinh dạng';
        } else {
            $password = $_POST['password'];
        }
    }

    $info = array(
        'username' => 'unitop',
        'password' => 'Kiet!@#',
    );
    if (empty($error)) {
        if ($username == $info['username'] && $password == $info['password']) {
            redirect_to("product.php");
        } else {
            $error['login'] = 'tk hoặc nk không chính xác';
        }
    }
}
?>
<?php get_header(); ?>
<div class="content">
    <form method="POST">
        Username:<input type="text" name="username" value="<?php echo set_value('username'); ?>" /> <br>
        <?php echo form_error('username'); ?> <br>
        Password:<input type="password" name="password"/> <br>
        <?php echo form_error('password'); ?> <br>
        <input type="submit" name="btn-login" value="Login"/>
        <?php echo form_error('login'); ?> <br>
    </form>
</div>
<?php get_footer(); ?>


