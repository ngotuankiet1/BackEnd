<?php  

function data_tree($data,$parent_id=1,$lever=0){
    $result = array();
    foreach($data as $item){
        if($item['cat_parent'] == $parent_id){
            $item['lever'] = $lever;
            $result[] = $item;
            $chile = data_tree($data,$item['cat_id'],$lever + 1);
            $result = array_merge($result,$chile);
        }
    }
    return $result;
}
