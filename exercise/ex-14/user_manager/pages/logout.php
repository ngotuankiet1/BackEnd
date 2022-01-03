<?php

setcookie("login", true, time() -3000);
setcookie("username", $username, time() - 3000);
unset($_SESSION['is_login']);
unset($_SESSION['users_login']);
redirect("?page=login");
