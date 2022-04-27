<?php
get_header();
//page
$list_page = db_fetch_array("SELECT * FROM `tbl_page`");
//post
$data_post = db_fetch_array("SELECT * FROM `tbl_post_cat`");
$list_cat_post = data_tree($data_post, 0);
//product
$data_product = db_fetch_array("SELECT * FROM `tbl_product_cat`");
$list_cat_product = data_tree($data_product, 0);
//menu
$list_menu = db_fetch_array("select * from `tbl_menu`");
?>
<div id="main-content-wp" class="add-cat-page menu-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="#" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Menu</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section-detail clearfix">
                <div id="list-menu" class="fl-left">
                    <form method="POST" action="?mod=menu&action=add_menu">
                        <?php echo form_error("success") ?>
                        <div class="form-group">
                            <label for="title">Tên menu</label>
                            <input type="text" name="title" value="<?php echo set_value("title") ?>" id="title">
                        </div>
                        <p class='mess_error'><?php echo form_error("title") ?></p>
                        <div class="form-group">
                            <label for="url-static">Đường dẫn tĩnh</label>
                            <input type="text" name="url_static" value="<?php echo set_value("url_static") ?>" id="url-static">
                            <p>Chuỗi đường dẫn tĩnh cho menu</p>
                        </div>
                        <?php echo form_error("url_static") ?>
                        <div class="form-group clearfix">
                            <label>Trang</label>
                            <select name="page_slug">
                                <option <?php if (!empty($_POST['page_slug']) && $_POST['page_slug'] == "0") echo "selected='selected'" ?> value="0">-- Chọn --</option>
                                <?php foreach ($list_page as $page) { ?>
                                    <option <?php if (!empty($_POST['page_slug']) && $_POST['page_slug'] == $page['title']) echo "selected='selected'" ?> value="<?php echo $page['title'] ?>"><?php echo $page['title'] ?></option>
                                <?php } ?>
                            </select>
                            <p>Trang liên kết đến menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label>Danh mục sản phẩm</label>
                            <select name="product_id">
                                <option <?php if (!empty($_POST['product_id']) && $_POST['product_id'] == "0") echo "selected='selected'" ?> value="0">-- Chọn --</option>
                                <?php foreach ($list_cat_product as $product) { ?>
                                    <option <?php if (!empty($_POST['product_id']) && $_POST['product_id'] == $product['title']) echo "selected='selected'" ?> value="<?php echo $product['title'] ?>"> <?php echo str_repeat('--', $product['lever']) . ' ' . $product['title']; ?> </option>
                                <?php } ?>
                            </select>
                            <p>Danh mục sản phẩm liên kết đến menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label>Danh mục bài viết</label>
                            <select name="post_id">
                                <option <?php if (!empty($_POST['post_id']) && $_POST['post_id'] == "0") echo "selected='selected'" ?> value="0">-- Chọn --</option>
                                <?php foreach ($list_cat_post as $post) { ?>
                                    <option <?php if (!empty($_POST['post_id']) && $_POST['post_id'] == $post['title']) echo "selected='selected'" ?> value="<?php echo $post['title'] ?>"> <?php echo str_repeat('--', $post['lever']) . ' ' . $post['title']; ?> </option>
                                <?php } ?>
                            </select>
                            <p>Danh mục bài viết liên kết đến menu</p>
                        </div>
                        <div class="form-group">
                            <label for="menu-order">Thứ tự</label>
                            <input type="text" name="menu_order" id="menu-order" value="<?php echo set_value("menu_order") ?>">
                        </div>
                        <?php echo form_error("menu_order") ?>
                        <p class='mess_error'></p>
                        <div class="form-group">
                            <button type="submit" name="sm_add" id="btn-save-list">Lưu danh mục</button>
                        </div>
                    </form>
                </div>
                <form method="POST" action="?mod=menu&action=apply_menu" id="category-menu" class="fl-right">
                    <div class="actions">
                        <select name="post_status">
                            <option value="-1">Tác vụ</option>
                            <option value="delete">Xóa vĩnh viễn</option>
                        </select>
                        <button type="submit" name="sm_block_status" id="sm-block-status">Áp dụng</button>
                        <?php echo form_error("select") ?>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên menu</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Slug</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                                </tr>
                            </thead>
                            <?php if (!empty($list_menu)) { ?>
                                <tbody>
                                    <?php $num_order = 0;
                                    foreach ($list_menu as $menu) { ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem[]" value="<?php echo $menu['menu_id']; ?>" class="checkItem" value="1"></td>
                                            <td><span class="tbody-text"><?php echo $num_order; ?></span>
                                            <td>
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $menu['title']; ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=menu&controller=index&action=edit&id=<?php echo $menu['menu_id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=menu&controller=index&action=delete&id=<?php echo $menu['menu_id']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td style="text-align: center;"><span class="tbody-text"><?php echo $menu['url_static']; ?></span></td>
                                            <td style="text-align: center;"><span class="tbody-text"><?php echo $menu['menu_order']; ?></span></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            <?php } else { ?>
                                <p>không có giá trị</p>
                            <?php } ?>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên menu</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Slug</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>