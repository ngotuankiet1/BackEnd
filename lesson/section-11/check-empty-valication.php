<?php
if (isset($_POST['btn-login'])) {
    $error = array();
    if (empty($_POST['username'])) {
        $error['username'] = 'không được để trống username';
    }else{
        $username = $_POST['username'];
    }
    if (empty($_POST['password'])) {
        $error['password'] = 'không được để trống password';
    }else{
        $password = $_POST['password'];
    }

    if(empty($error)){
        echo $username."-".$password;
    }
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
            username:<input type="text" name="username"/><br>
            <p><?php if (!empty($error["username"])) echo $error["username"]; ?></p>
            password:<input type="password" name="password"/><br>
            <p><?php if (!empty($error["password"])) echo $error["password"]; ?></p>
            <input type="submit" name="btn-login" value="Login"/>
        </form>
    </body>
</html>

