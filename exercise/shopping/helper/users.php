<?php

function is_login() {
    if (isset($_SESSION['is_login'])) {
        return true;
    }
    return false;
}

function get_info_product($id) {
    $result = db_fetch_row("select * from `list_product` where `id` = '{$id}'");
    $result['url_add_cart'] = "?mod=cart&action=add&id={$id}";
    return $result;
}

function get_users($start, $num_pers_page, $where = '',$cat_id) {
    $temp = array();
    if (!empty($where)) {
        $sql_where = "WHERE {$where}";
        $result = db_fetch_array("select * from `list_product` $sql_where LIMIT {$start},{$num_pers_page}");
    } else {
        $result = db_fetch_array("select * from `list_product` LIMIT {$start},{$num_pers_page}");
    }
    foreach ($result as $item) {
        if ($item['cat_id'] == $cat_id) {
            $item['url_product'] = "?mod=product&action=detail&id={$item['id']}";
            $temp[] = $item;
        }
    }
    return $temp;
}

function get_pagging($num_page, $page, $base_url = "") {
    $str_pagging = "<ul class='list-pagenavi'>";
    if ($page > 1) {
        $str_prev = $page - 1;
        $str_pagging .= "<li><a href=\"{$base_url}&page=$str_prev\"><< Trước</a></li>";
    }
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page)
            $active = "class = 'active'";
        $str_pagging .= "<li><a {$active} href=\"{$base_url}&page={$i}\">{$i}</a></li>";
    }
    if ($page < $num_page) {
        $str_next = $page + 1;
        $str_pagging .= "<li><a href=\"{$base_url}&page=$str_next\">Sau >></a></li>";
    }
    $str_pagging .= "</ul>";
    return $str_pagging;
}
?>

