<?php

setcookie("login", true, time() -3000);
setcookie("users_login", $username, time() - 3000);
unset($_SESSION['is_login']);
unset($_SESSION['users_login']);
redirect("?mod=users&action=login");

