<?php
//danh sách nhân viên

$list_user = array(
    1 => array(
        "id" => 1,
        "first and lastname" => "ngô tuấn kiệt",
        "old" => 20,
    ),
    2 => array(
        "id" => 2,
        "first and lastname" => "Dương văn lâm",
        "old" => 20,
    ),
    3 => array(
        "id" => 3,
        "first and lastname" => "Lê tấn tài",
        "old" => 40,
    )
);

//danh sách sản phẩm
$list_products = array(
    1 => array(
        "id" => 1,
        "products name" => "máy lạnh",
        "price" => "2000000",
    ),
    2 => array(
        "id" => 2,
        "products name" => "máy sưởi",
        "price" => "2000000",
    ),
    3 => array(
        "id" => 3,
        "products name" => "máy tính",
        "price" => "2000000",
    ),
);

$lastname = "Cương";
$birthday = "1988";
$weight = "62,5kg";
?>
<html>
    <head>
        <title>hiển thị thông tin cá nhân</title>
    </head>
    <body>
        <p>
            Tôi tên <strong><?php echo "$lastname" ?></strong>,
            sinh năm <strong><?php echo "$birthday" ?></strong>,
            cân nặng <strong><?php echo "$weight" ?></strong>
        </p>
    </body>
</html>