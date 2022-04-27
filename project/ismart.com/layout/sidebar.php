<?php
$cat_product_0 = db_fetch_array("select * from `tbl_product_cat` where `cat_parent` = 0");
$list_product =  db_fetch_array("select * from `tbl_product` ORDER BY `sold_product` DESC");
$list_selling_products = array_slice($list_product,0,8);
?>
<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <?php if (!empty($cat_product_0)) { ?>
                <ul class="list-item">
                    <?php foreach ($cat_product_0 as $parent) { ?>
                        <li>
                            <a href="danh-muc/<?php echo $parent['slug']; ?>-<?php echo $parent['cat_id'] ?>.html" title=""> <?php echo $parent['title']; ?> </a>
                            <?php
                            $cat_parent_1 = db_fetch_array("select * from `tbl_product_cat` where `cat_parent` = {$parent['cat_id']}");
                            if (!empty($cat_parent_1)) {
                            ?>
                                <ul class="sub-menu">
                                    <?php foreach ($cat_parent_1 as $child_1) { ?>
                                        <li>
                                            <a href="danh-muc/<?php echo $child_1['slug']; ?>-<?php echo $child_1['cat_id'] ?>.html" title=""><?php echo $child_1['title']; ?></a>
                                            <?php
                                            $cat_parent_2 = db_fetch_array("select * from `tbl_product_cat` where `cat_parent` = {$child_1['cat_id']}");
                                            if (!empty($cat_parent_2)) {
                                            ?>
                                                <ul class="sub-menu">
                                                    <?php foreach ($cat_parent_2 as $child_2) { ?>
                                                        <li>
                                                            <a href="danh-muc/<?php echo $child_2['slug']; ?>-<?php echo $child_2['cat_id'] ?>.html" title=""><?php echo $child_2['title']; ?></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <div class="section-detail">
            <?php if(!empty($list_selling_products)){?>
            <ul class="list-item">
                <?php foreach($list_selling_products as $item){ ?>
                <li class="clearfix">
                    <a href="chi-tiet/<?php echo $item['slug']; ?>-<?php echo $item['product_id']; ?>.html" title="" class="thumb fl-left">
                        <img src="admin/<?php if(!empty($item['images'])){echo $item['images'];}else{echo "public/images/files/product/img-thumb";} ?>" alt="">
                    </a>
                    <div class="info fl-right">
                        <a href="chi-tiet/<?php echo $item['slug']; ?>-<?php echo $item['product_id']; ?>.html" title="" class="product-name"><?php echo $item['product_name'] ?></a>
                        <div class="price">
                            <span class="new"><?php echo currency_format($item['price_new']) ?></span>
                            <span class="old"><?php echo currency_format($item['price_old']) ?></span>
                        </div>
                        <a href="dat-hang-<?php echo $item['product_id']; ?>-b.html" title="" class="buy-now">Mua ngay</a>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <?php }else{ ?>
                <p>Không có sản phẩm bán chạy</p>
            <?php } ?>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>