<?php
get_header();
global $value, $list_all_products_search;
if (isset($_GET['value'])) {
    if (!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
}
$list_cat_all_search = get_list_cat_all_search($value);
$list_all_products_search = list_all_products_search($value);
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
                        <a href="" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="filter-wp fl-right">
                <p class="desc">Hiển thị <?php echo count($list_all_products_search) ?> sản phẩm</p>
                <div class="form-filter">
                    <form method="POST" action="loc-<?php echo $value; ?>.html">
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
            <?php if (!empty($list_cat_all_search)) { ?>
                <?php foreach ($list_cat_all_search as $product_cat) {
                    $cat_id = get_cat_id_by_cat($product_cat['parent_cat']);
                    if (isset($_POST['filter'])) {
                        $error = array();
                        if (!empty($_POST['select'])) {
                            if ($_POST['select'] == 1) {
                                $list_product_by_cat = get_list_all_products_search_by_cat($product_cat['parent_cat'], $value, "ORDER BY `product_name` ASC");
                            }

                            if ($_POST['select'] == 2) {
                                $list_product_by_cat = get_list_all_products_search_by_cat($product_cat['parent_cat'], $value, "ORDER BY `product_name` DESC");
                            }

                            if ($_POST['select'] == 3) {
                                $list_product_by_cat = get_list_all_products_search_by_cat($product_cat['parent_cat'], $value, "ORDER BY `price_new` DESC");
                            }

                            if ($_POST['select'] == 4) {
                                $list_product_by_cat = get_list_all_products_search_by_cat($product_cat['parent_cat'], $value, "ORDER BY `price_new` ASC");
                            }
                        } else {
                            $error['filter'] = "Vui lòng chọn tác vụ";
                            $list_product_by_cat = get_list_all_products_search_by_cat($product_cat['parent_cat'], $value);
                        }
                    } else {
                        $list_product_by_cat = get_list_all_products_search_by_cat($product_cat['parent_cat'], $value);
                    }

                    // =============PAGGING================
                    if (!empty($list_product_by_cat)) {
                        #Số bản ghi/trang
                        $num_per_page = 4;

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
                            <h3 class="section-title fl-left"><?php echo $product_cat['parent_cat']; ?></h3>
                        </div>
                        <div id="<?php echo $cat_id; ?>">
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
                                        if (!empty($list_product_page)) {
                                            echo get_pagging_search_all($num_page, $page_num, $value, $cat_id);
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>Không tìm thấy sản phẩm nào!</p>
            <?php } ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>