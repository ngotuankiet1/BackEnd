<?php

//==========================================
//bt1: xây dựng hàm kiểm tra số nguyên chẵn
//==========================================
#in trong dòng
//function check_even($n) {
//    if ($n % 2 == 0) {
//        echo "$n là sô chẵn";
//    } else {
//        echo "$n là sô lẻ";
//    }
//}
//
//check_even(6);
#hàm trả về
//function check_even($n) {
//    if ($n % 2 == 0)
//        return true;
//    return false;
//}
//
//;
//
//if (check_even(7))
//    echo "là sô chẵn";
//else
//    echo "là sô lẻ";
//==========================================
//bt2: xây dựng hàm tính tổng số từ $2 -> $n($n>=2)
//==========================================
#c1
//function check_prime($n) {
//    if ($n < 2) {
//        return false;
//    } elseif ($n == 2) {
//        return true;
//    } else {
//        $count = 0;
//        for ($i = 2; $i < $n; $i++) {
//            if ($n % $i == 0) {
//                $count++;
//            }
//        }
//        if ($count == 0) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//}
#c2
//function check_prime($n) {
//    for ($i = 2; $i <= sqrt($n); $i++) {
//        if ($n % $i == 0)
//            return false;
//    }
//    return true;
//}
//echo check_prime(9);
//function total_prime($n1) {
//    $s = 0;
//    for ($i = 2; $i <= $n1; $i++) {
//        if (check_prime($i)) {
//            $s += $i;
//        }
//    }
//    return $s;
//}
//
//echo "tong:".check_prime(7);
//==========================================
//bt3: xây dựng hàm lấy thông tin chi tiết bài viết theo id  trong mảng bài viết
//==========================================
function show_array($data) {
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}

$list_news = array(
    1 => array(
        "id" => 1,
        "title" => "Bình Dương có 1 ca dương tính",
        "detail" => "ca dương tính không có gì đáng nghiêm trọng",
    ),
    2 => array(
        "id" => 2,
        "title" => "Bình Dương có 1 ca dương tínhaa",
        "detail" => "ca dương tính không có gì đáng nghiêm trọng",
    )
);

//function get_id_news() {
//    global $list_news;
//    $id = func_get_arg(0);
//    foreach ($list_news as $value) {
//        if ($value["id"] == $id) {
//            show_array($value);
//        }
//    }
//}

#c1
//function get_post($id) {
//    global $list_news;
//    foreach ($list_news as $key => $item) {
//        if ($key == $id) {
//            return $list_news[$id];
//        }
//    }
//    return false;
//}

#cách ngắn gọn
function get_post($id) {
    global $list_news;
    if(array_key_exists($id, $list_news)){
        return $list_news[$id];
    }
    return false;
}

$item = get_post(1);
show_array($item);