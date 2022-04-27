<?php $cat_product_0 = db_fetch_array("select * from `tbl_product_cat` where `cat_parent` = 0"); ?>
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
    <div class="section" id="filter-product-wp">
        <div class="section-head">
            <h3 class="section-title">Bộ lọc</h3>
        </div>
        <div class="section-detail">
            <form method="POST" action="">
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Giá</td>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                            <td><input class="common_selector filter-price" type="radio" name="r-price" value="0"></td>
                            <td>Tất cả</td>
                        </tr>
                        <tr>
                            <td><input class="common_selector filter-price" type="radio" name="r-price" value="1"></td>
                            <td>Dưới 500.000đ</td>
                        </tr>
                        <tr>
                            <td><input class="common_selector filter-price" type="radio" name="r-price" value="2"></td>
                            <td>500.000đ - 1.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input class="common_selector filter-price" type="radio" name="r-price" value="3"></td>
                            <td>1.000.000đ - 5.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input class="common_selector filter-price" type="radio" name="r-price" value="4"></td>
                            <td>5.000.000đ - 10.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input class="common_selector filter-price" type="radio" name="r-price" value="5"></td>
                            <td>Trên 10.000.000đ</td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Hãng</td>
                        </tr>
                    </thead>
                    <?php
                    $cat_id = $_GET['cat_id'];
                    $product_cat_title = db_fetch_array("select * from `tbl_product_cat` where `cat_parent` = '{$cat_id}'");
                    if (!empty($product_cat_title)) {
                    ?>
                        <tbody>
                            <tr>
                                <td><input class="common_selector filter-brand" type="radio" name="r-brand" value=""></td>
                                <td>tất cả</td>
                            </tr>
                            <?php foreach ($product_cat_title as $brand) { ?>
                                <tr>
                                    <td><input class="common_selector filter-brand" type="radio" name="r-brand" value="<?php echo $brand['title']; ?>"></td>
                                    <td><?php echo $brand['title']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php } ?>
                </table>
            </form>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="?page=detail_product" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>