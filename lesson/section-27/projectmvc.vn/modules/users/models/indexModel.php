<?php

function get_list_user() {
    $result = db_fetch_array("select * from `tbl_user`");
    return $result;
}

function get_id_user($id) {
    $item = db_fetch_row("select * from `tbl_user` where `id` = {$id}");
    return $item;
}
