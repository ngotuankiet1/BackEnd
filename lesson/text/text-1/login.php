<?php
session_start();
require 'database/array.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if($username == $info_login[1]['username'] && $password == $info_login[1]['password']){
        $_SESSION['login']=true;
        header("Location: index.php");
    }else{
        echo 'tk mk sai ';
    }
}
?>
<html>
    <body>
        <form method="POST">
            <input type="text" name="username"><br><br>
            <input type="password" name="password"><br>
            <input type="submit" name="login" value="dang nhap">
        </form>
    </body>
</html>
