<?php
require 'lb/validation.php';
if(isset($_POST['btn_login']))
{
    $error = array();
    if(empty($_POST['username']))
    {
        $error['username'] = "khong duoc de trong";
    }else{
        if(!is_username($_POST['username'])){
            $error['username'] = "dinh dang khong dung";
        }else{
            $usename = $_POST['username'];
        }
    }
    
     if(empty($_POST['password']))
    {
        $error['password'] = "khong duoc de trong";
    }else{
        if(!is_password($_POST['password'])){
            $error['password'] = "dinh dang khong dung";
        }else{
            $password = $_POST['password'];
        }
    }
    
    if(empty($error)){
        echo "{$usename}-{$password}";
    }
}
?>
<html>
    <head>
        <title>tieu de</title>
    </head>
    <body>
        <form method="POST">
            Username: <input type="text" name="username" value="<?php echo set_value('username'); ?>"/><br><br>
            <?php echo form_error('username'); ?>
            Password: <input type="password" name="password"/><br>
            <?php echo form_error('password'); ?>
            <input type="submit" name="btn_login" value="Login"/>
        </form>
    </body>
</html>