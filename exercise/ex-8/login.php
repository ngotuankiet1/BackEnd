<?php
$error = array();
if (isset($_POST['btn-login'])) {
    if (empty($_POST['username'])) {
        $error["username"] = 'Không để trống username';
    } else {
        $username = $_POST['username'];
        echo "Username: $username" . "<br>";
    }
    if (empty($_POST['password'])) {
        $error["password"] = 'Không để trống password';
    } else {
        $password = $_POST['password'];
        echo "Password: $password" . "<br>";
    }

    echo '<pre>';
    print_r($error);
    echo '</pre>';
}
?>

<html>
    <form method="POST">
        username:<input type="text" name="username" /> <br><br>
        password:<input type="password" name="password" /> <br><br>
        <button name="btn-login">Login</button>
    </form>
</html>

