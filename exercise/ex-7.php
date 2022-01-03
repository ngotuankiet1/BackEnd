<?php
#B1
//function num_page($total_rows,$num_per_page){
//    $t=0;
//    $t=$total_rows/$num_per_page;
//    return $t;
//}
//
//echo "số trang là: ".ceil(num_page(10, 3));
//========================================================
//#bt2: Xuất 1 mảng số nguyên chẵn từ một mảng số nguyên cho trước
//$a = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
//echo "<pre>";
//print_r($a);
//echo "</pre>";
//
//function even_output($array) {
//    $t[] = 0;
//    if (is_array($array)) {
//        foreach ($array as $item) {
//            if ($item % 2 == 0) {
//                $t[] = $item;
//            }
//        }
//        echo "<pre>";
//        print_r($t);
//        echo "</pre>";
//    }
//}
//
//even_output($a);
//==========================================================
#bt3
//Giáo dục
//--Khuyến học
//--du học
//thể thao
//--châu âu
//--châu á

$list_news = array(
    1 => array(
        "id" => 1,
        "title" => "Giáo dục",
        "lever" => 0,
    ),
    2 => array(
        "id" => 2,
        "title" => "Khuyến học",
        "lever" => 1,
    ),
    3 => array(
        "id" => 3,
        "title" => "Du học",
        "lever" => 1,
    ),
    4 => array(
        "id" => 4,
        "title" => "thể thao",
        "lever" => 0,
    ),
    5 => array(
        "id" => 5,
        "title" => "châu âu",
        "lever" => 1,
    ),
    6 => array(
        "id" => 6,
        "title" => "châu á",
        "lever" => 1,
    )
);
?>

<html>
    <body>
        <table>
            <tbody>
                <?php
                if (!empty($list_news)) {
                    $temp=0;
                    foreach ($list_news as $item) {
                        $temp++;
                        ?>
                <tr>
                    <td><?php echo $temp ?></td>
                    <td><?php echo str_repeat("--", $item["lever"])." ".$item["title"] ?></td>
                </tr>
                    <?php }
                } ?>
            </tbody>
        </table>
    </body>
</html>
