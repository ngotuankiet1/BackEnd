<?php
get_header();
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $item = db_fetch_row("select * from `tbl_menu` where `menu_id` = '{$id}'");
}
//page
$list_page = db_fetch_array("SELECT * FROM `tbl_page`");
//post
$data_post = db_fetch_array("SELECT * FROM `tbl_post_cat`");
$list_cat_post = data_tree($data_post, 0);
//product
$data_product = db_fetch_array("SELECT * FROM `tbl_product_cat`");
$list_cat_product = data_tree($data_product, 0);

?>
<div id="main-content-wp" class="add-cat-page menu-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="#" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">update menu</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section-detail clearfix">
                <div id="list-menu" class="fl-left">
                    <form method="POST" ">
                        <?php echo form_error("success"); ?>
                        <div class="form-group">
                            <label for="title">Tên menu</label>
                            <input type="text" name="title" value="<?php echo $item['title']; ?>" id="title">
                        </div>
                        <p class='mess_error'><?php echo form_error("title") ?></p>
                        <div class="form-group">
                            <label for="url-static">Đường dẫn tĩnh</label>
                            <input type="text" name="url_static" value="<?php echo $item['url_static']; ?>" id="url-static">
                            <p>Chuỗi đường dẫn tĩnh cho menu</p>
                        </div>
                        <?php echo form_error("url_static") ?>
                        <div class="form-group clearfix">
                            <label>Trang</label>
                            <select name="page_slug">
                                <option <?php if (!empty($_POST['page_slug']) && $_POST['page_slug'] == "0") echo "selected='selected'" ?> value="0">-- Chọn --</option>
                                <?php foreach ($list_page as $page) { ?>
                                    <option <?php if (!empty($item['page_slug']) && $item['page_slug'] == $page['title']) echo "selected='selected'" ?> value="<?php echo $page['title'] ?>"><?php echo $page['title'] ?></option>
                                <?php } ?>
                            </select>
                            <p>Trang liên kết đến menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label>Danh mục sản phẩm</label>
                            <select name="product_id">
                                <option <?php if (!empty($_POST['product_id']) && $_POST['product_id'] == "0") echo "selected='selected'" ?> value="0">-- Chọn --</option>
                                <?php foreach ($list_cat_product as $product) { ?>
                                    <option <?php if (!empty($item['product_id']) && $item['product_id'] == $product['title']) echo "selected='selected'" ?> value="<?php echo $product['title'] ?>"> <?php echo str_repeat('--', $product['lever']) . ' ' . $product['title']; ?> </option>
                                <?php } ?>
                            </select>
                            <p>Danh mục sản phẩm liên kết đến menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label>Danh mục bài viết</label>
                            <select name="post_id">
                                <option <?php if (!empty($_POST['post_id']) && $_POST['post_id'] == "0") echo "selected='selected'" ?> value="0">-- Chọn --</option>
                                <?php foreach ($list_cat_post as $post) { ?>
                                    <option <?php if (!empty($item['post_id']) && $item['post_id'] == $post['title']) echo "selected='selected'" ?> value="<?php echo $post['title'] ?>"> <?php echo str_repeat('--', $post['lever']) . ' ' . $post['title']; ?> </option>
                                <?php } ?>
                            </select>
                            <p>Danh mục bài viết liên kết đến menu</p>
                        </div>
                        <div class="form-group">
                            <label for="menu-order">Thứ tự</label>
                            <input type="text" name="menu_order" id="menu-order" value="<?php echo $item['menu_order']; ?>">
                        </div>
                        <?php echo form_error("menu_order") ?>
                        <p class='mess_error'></p>
                        <div class="form-group">
                            <button type="submit" name="sm_add" id="btn-save-list">Lưu danh mục</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>