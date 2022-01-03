<?php
$error = array();
if (isset($_POST['register'])) {
    $name = $_POST['name'];

    $username = $_POST['username'];

    $password = $_POST['password'];

    $email = $_POST['email'];

    $phone = $_POST['phone'];

    $sex = $_POST['Sex'];
    echo "$name - $username - $password - $email - $phone-$sex";
}
?>

<html>
    <form method="POST">
        first-last-name: <input type="text" name="name" /> <br> <br>
        Username: <input type="text" name="username" /><br> <br>
        Password: <input type="password" name="password" /><br> <br>
        Email: <input type="email" name="email" /><br> <br>
        Phone: <input type="text" name="phone" /><br> <br>
        Male<input type="radio" name="Sex" checked="checked"  value="male"/>
        Female<input type="radio" name="Sex"  value="female"/> <br><br>
        <button name="register">Register</button>
    </form>
</html>

