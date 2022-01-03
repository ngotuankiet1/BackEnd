<?php
unset($_SESSION['is_login']);
unset($_SESSION['users_login']);
redirect("?page=login");