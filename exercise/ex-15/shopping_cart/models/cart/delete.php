<?php

$id = $_GET['id'];
delete_cart($id);
redirect("?model=cart&act=show");
