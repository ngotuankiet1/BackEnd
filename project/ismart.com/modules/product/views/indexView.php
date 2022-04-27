<?php
get_header();
$mod = $_GET['mod'];
$action = $_GET['action'];
$list_products = db_fetch_array("SELECT * FROM `tbl_product` WHERE `status` = 'Approved' ORDER BY `product_id` DESC");
$list_product_cat = db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `cat_parent` = 0");

?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title=""><?php echo get_title($mod, $action); ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="filter-wp fl-right">
                <p class="desc">Hiển thị <?php echo count($list_products) ?> sản phẩm</p>
                <div class="form-filter">
                    <form method="POST" action="">
                        <select name="select" id="filter-arrange">
                            <option <?php if (!empty($_POST['select']) && $_POST['select'] == '0') echo "selected='selected'"; ?> value="0">Sắp xếp</option>
                            <option <?php if (!empty($_POST['select']) && $_POST['select'] == '1') echo "selected='selected'"; ?> value="1">Từ A-Z</option>
                            <option <?php if (!empty($_POST['select']) && $_POST['select'] == '2') echo "selected='selected'"; ?> value="2">Từ Z-A</option>
                            <option <?php if (!empty($_POST['select']) && $_POST['select'] == '3') echo "selected='selected'"; ?> value="3">Giá cao xuống thấp</option>
                            <option <?php if (!empty($_POST['select']) && $_POST['select'] == '4') echo "selected='selected'"; ?> value="4">Giá thấp lên cao</option>
                        </select>
                        <button type="submit" name="filter">Lọc</button>
                        <?php echo form_error("filter"); ?>
                    </form>
                </div>
            </div>
            <?php if (!empty($list_product_cat)) { ?>
                <?php foreach ($list_product_cat as $product_cat) {
                    if (isset($_POST['filter'])) {
                        $error = array();
                        if (!empty($_POST['select'])) {
                            if ($_POST['select'] == 1) {
                                $list_product_by_cat = get_product_by_parent_cat($product_cat['title'], "ORDER BY `product_name` ASC");
                            }

                            if ($_POST['select'] == 2) {
                                $list_product_by_cat = get_product_by_parent_cat($product_cat['title'], "ORDER BY `product_name` DESC");
                            }

                            if ($_POST['select'] == 3) {
                                $list_product_by_cat = get_product_by_parent_cat($product_cat['title'], "ORDER BY `price_new` DESC");
                            }

                            if ($_POST['select'] == 4) {
                                $list_product_by_cat = get_product_by_parent_cat($product_cat['title'], "ORDER BY `price_new` ASC");
                            }
                        } else {
                            $error['filter'] = "Vui lòng chọn tác vụ";
                            $list_product_by_cat = get_product_by_parent_cat($product_cat['title']);
                        }
                    } else {
                        $list_product_by_cat = get_product_by_parent_cat($product_cat['title']);
                    }

                    // =============PAGGING================
                    if (!empty($list_product_by_cat)) {
                        #Số bản ghi/trang
                        $num_per_page = 8;

                        #Tổng số bản ghi
                        $total_row = count($list_product_by_cat);
                        #Số trang
                        $num_page = ceil($total_row / $num_per_page);

                        #chỉ số bắt đầu của trang
                        $page_num = 1;
                        $start = ($page_num - 1) * $num_per_page;

                        $list_product_page = array_slice($list_product_by_cat, $start, $num_per_page);
                    } else {
                        $num_page = 0;
                    }
                ?>
                    <div class="section" id="list-product-wp">
                        <div class="section-head clearfix">
                            <h3 class="section-title fl-left"><?php echo $product_cat['title']; ?></h3>
                        </div>
                        <div id="<?php echo $product_cat['cat_id']; ?>">
                            <div class="section-detail">
                                <?php if (!empty($list_product_page)) { ?>
                                    <ul class="list-item clearfix">
                                        <?php foreach ($list_product_page as $product) { ?>
                                            <li>
                                                <a href="chi-tiet/<?php echo $product['slug']; ?>-<?php echo $product['product_id']; ?>.html" title="" class="thumb">
                                                    <img src="admin/<?php if (!empty($product['images'])) {
                                                                        echo $product['images'];
                                                                    } else {
                                                                        echo "public/images/files/product/img-thumb";
                                                                    } ?>">
                                                </a>
                                                <a href="chi-tiet/<?php echo $product['slug']; ?>-<?php echo $product['product_id']; ?>.html" title="" class="product-name"><?php echo $product['product_name'] ?></a>
                                                <div class="price">
                                                    <span class="new"><?php echo currency_format($product['price_new']) ?></span>
                                                    <span class="old"><?php echo currency_format($product['price_old']) ?></span>
                                                </div>
                                                <div class="action clearfix">
                                                    <a href="gio-hang-<?php echo $product['product_id']; ?>-c.html" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                                    <a href="dat-hang-<?php echo $product['product_id']; ?>-b.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } else { ?>
                                    <p>không có sản phẩm!</p>
                                <?php } ?>
                            </div>

                            <div class="section" id="paging-wp">
                                <div class="section-detail">
                                    <ul class="list-item clearfix">
                                        <?php
                                        if (!empty($list_products)) {
                                            echo get_pagging_all($num_page, $page_num, $product_cat['cat_id']);
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>