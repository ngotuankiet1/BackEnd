<?php

unset($_SESSION['is_login']);
unset($_SESSION['users_login']);
redirect("?mod=users&action=login");

