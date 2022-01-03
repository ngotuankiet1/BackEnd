<?php
$info_product = array(
    "1" => array(
        "product_name" => "máy lạnh nhật bản",
        "product_title" => "sản phẩm nhật bản mới hiện đại nhất 2021",
        "product_price" => "5.000.000VNĐ",
    ),
    "2" => array(
        "product_name" => "máy giặc nhật bản",
        "product_title" => "sản phẩm nhật bản mới hiện đại nhất 2019",
        "product_price" => "10.000.000VNĐ",
    ),
    "3" => array(
        "product_name" => "robot nhật bản",
        "product_title" => "sản phẩm nhật bản mới hiện đại nhất 2022",
        "product_price" => "100.000.000VNĐ",
    ),
);
?>
<style>
    #content a{
        color: black;
        display: block;
    }
</style>
<div id="content">
    <ul>
        <?php
        $count = 0;
        foreach ($info_product as $item) {
            $count++;
            ?>
            <li>
                <a href=""><?php echo $count; ?></a>
                <a href=""><?php echo $item['product_name']; ?></a>
                <a href=""><?php echo $item['product_title']; ?></a>
                <a href=""><?php echo $item['product_price']; ?></a>
            </li>
        <?php } ?>
    </ul>
</div>