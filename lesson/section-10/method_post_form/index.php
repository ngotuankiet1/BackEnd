<?php

function show_array($data) {
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}

//show_array($_SERVER);
#kiểm tra người dùng đã POST chưa
if ($_SERVER['REQUEST_METHOD']=="POST") {
    show_array($_POST);
    
    $usename = $_POST['usename'];
    $password = $_POST['password'];
    echo "$usename - $password";
}
?>

<html>
    <body>
        <form action="" method="post">
            usename:<input type="text" name="usename"/><br>
            password:<input type="password" name="password"/><br>
            <input type="submit" name="btn-login" value="Login"/>
        </form>
    </body>
</html>

