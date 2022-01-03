
<?php
if (isset($_POST['btn-login'])) {
    $info = array(
        'username' => 'admin',
        'password' => 'admin'
    );

    $error = array();
    if (empty($_POST['username'])) {
        $error['username'] = 'vui long nhap username';
    } else {
        $username = $_POST['username'];
    }
    if (empty($_POST['password'])) {
        $error['password'] = 'vui long nhap password';
    } else {
        $password = $_POST['password'];
    }

    if (empty($error)) {
        if ($username == $info['username'] && $password == $info['password']){
            $redirect_to = $_POST['redirect_to'];
            header("location:{$redirect_to}");
        }else{
            $error['login']='tk hoac mk khong chinh xac';
        }
    }
    if(!empty($error)){
        echo '<pre>';
        print_r($error);
        echo '</pre>';
    }
}
?>


<html>
    <body>
        <form action="" method="post">
            Username: <input type="text" name="username"/><br><br>
            Password: <input type="password" name="password"/><br><br>
            <input type="hidden" name="redirect_to" value="cart.php"/>
            <input type="submit" name="btn-login" value="Login"/>
        </form>
    </body>
</html>