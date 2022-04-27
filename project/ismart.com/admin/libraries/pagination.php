<?php
function get_pagging($num_page, $page, $base_url = "") {
    $str_pagging = "<ul class='pagging fl-right' id='list-paging'>";
    if ($page > 1) {
        $str_prev = $page - 1;
        $str_pagging .= "<li><a href=\"{$base_url}&page=$str_prev\"><<</a></li>";
    }
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page)
            $active = "class = 'active'";
        $str_pagging .= "<li><a {$active} href=\"{$base_url}&page={$i}\">{$i}</a></li>";
    }
    if ($page < $num_page) {
        $str_next = $page + 1;
        $str_pagging .= "<li><a href=\"{$base_url}&page=$str_next\">>></a></li>";
    }
    $str_pagging .= "</ul>";
    return $str_pagging;
}

function db_num_page($tbl, $record){
    global $conn;
    #Số lượng trang
    $sql = "SELECT* FROM $tbl";
    $num_rows = db_num_rows($sql);
    $num_page = ceil($num_rows / $record);
    # danh sách số thứ tự trang 1,2,3,4....
    $list_num_page = array();
    for ($i = 1; $i <= $num_page; $i++) {
        $list_num_page[] = $i;
    }
    return $list_num_page;
}
?>