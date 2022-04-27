<?php
get_header();
$get_admin = db_fetch_array("select * from `tbl_admin`");
$get_product = db_fetch_array("select * from `tbl_product`");
$get_post = db_fetch_array("select * from `tbl_post`");
$get_slider = db_fetch_array("select * from `tbl_slider`");
$total = count($get_admin) + count($get_product) + count($get_post) + count($get_slider);
?>
<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách media</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo $total; ?></span>)</a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="media">
                            <input type="hidden" name="controller" value="index">
                            <input type="hidden" name="action" value="search_media">
                            <input type="text" name="value" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <form method="POST" action="?mod=media&action=apply_media">
                        <div class="actions">
                            <div class="form-actions">
                                <select name="actions">
                                    <option value="0">Tác vụ</option>
                                    <option value="1">Xóa</option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tên file</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian tạo</span></td>
                                    </tr>
                                </thead>
                                <?php if ($total != 0) { ?>
                                    <tbody>
                                        <!-- ==================admin=================== -->
                                        <td><span class="tbody-text">ADMIN</h3></span>
                                            <?php $order = 0;
                                            foreach ($get_admin as $admin) {
                                                $order++; ?>
                                                <tr>
                                                    <td><input type="checkbox" name="checkItem[]" <?php echo $admin['id']; ?> class="checkItem"></td>
                                                    <td><span class="tbody-text"><?php echo $order; ?></h3></span>
                                                    <td>
                                                        <div class="tbody-thumb">
                                                            <img src="<?php if (!empty($admin['avatar'])) {
                                                                            echo $admin['avatar'];
                                                                        } else {
                                                                            echo "public/images/files/users/img-thumb.png";
                                                                        } ?>" alt="">
                                                        </div>
                                                    </td>
                                                    <td class="clearfix">
                                                        <div class="tb-title fl-left">
                                                            <a href="" title=""><?php echo basename($admin['avatar']) ?></a>
                                                        </div>
                                                        <ul class="list-operation fl-right">
                                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </td>
                                                    <td><span class="tbody-text"><?php echo $admin['creator'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $admin['reg_date'] ?></span></td>
                                                </tr>
                                            <?php } ?>
                                            <!-- ==================product=================== -->
                                        <td><span class="tbody-text">PRODUCT</h3></span>
                                            <?php $order = 0;
                                            foreach ($get_product as $product) {
                                                $order++; ?>
                                                <tr>
                                                    <td><input type="checkbox" name="checkItem[]" <?php echo $product['product_id']; ?> class="checkItem"></td>
                                                    <td><span class="tbody-text"><?php echo $order; ?></h3></span>
                                                    <td>
                                                        <div class="tbody-thumb">
                                                            <img src="<?php if (!empty($product['images'])) {
                                                                            echo $product['images'];
                                                                        } else {
                                                                            echo "public/images/files/users/img-thumb.png";
                                                                        } ?>" alt="">
                                                        </div>
                                                    </td>
                                                    <td class="clearfix">
                                                        <div class="tb-title fl-left">
                                                            <a href="" title=""><?php echo basename($product['images']) ?></a>
                                                        </div>
                                                        <ul class="list-operation fl-right">
                                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </td>
                                                    <td><span class="tbody-text"><?php echo $product['creator'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $product['date'] ?></span></td>
                                                </tr>
                                            <?php } ?>
                                            <!-- ==================POST=================== -->
                                        <td><span class="tbody-text">POST</h3></span>
                                            <?php $order = 0;
                                            foreach ($get_post as $post) {
                                                $order++; ?>
                                                <tr>
                                                    <td><input type="checkbox" name="checkItem[]" <?php echo $post['id']; ?> class="checkItem"></td>
                                                    <td><span class="tbody-text"><?php echo $order; ?></h3></span>
                                                    <td>
                                                        <div class="tbody-thumb">
                                                            <img src="<?php if (!empty($post['images'])) {
                                                                            echo $post['images'];
                                                                        } else {
                                                                            echo "public/images/files/users/img-thumb.png";
                                                                        } ?>" alt="">
                                                        </div>
                                                    </td>
                                                    <td class="clearfix">
                                                        <div class="tb-title fl-left">
                                                            <a href="" title=""><?php echo basename($post['images']) ?></a>
                                                        </div>
                                                        <ul class="list-operation fl-right">
                                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </td>
                                                    <td><span class="tbody-text"><?php echo $post['creator'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $post['date'] ?></span></td>
                                                </tr>
                                            <?php } ?>
                                            <!-- ==================SLIDER=================== -->
                                        <td><span class="tbody-text">SLIDER</h3></span>
                                            <?php $order = 0;
                                            foreach ($get_slider as $slider) {
                                                $order++; ?>
                                                <tr>
                                                    <td><input type="checkbox" name="checkItem[]" <?php echo $slider['slider_id']; ?> class="checkItem"></td>
                                                    <td><span class="tbody-text"><?php echo $order; ?></h3></span>
                                                    <td>
                                                        <div class="tbody-thumb">
                                                            <img src="<?php if (!empty($slider['images_slider'])) {
                                                                            echo $slider['images_slider'];
                                                                        } else {
                                                                            echo "public/images/files/users/img-thumb.png";
                                                                        } ?>" alt="">
                                                        </div>
                                                    </td>
                                                    <td class="clearfix">
                                                        <div class="tb-title fl-left">
                                                            <a href="" title=""><?php echo basename($slider['images_slider']) ?></a>
                                                        </div>
                                                        <ul class="list-operation fl-right">
                                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </td>
                                                    <td><span class="tbody-text"><?php echo $slider['creator'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $slider['date'] ?></span></td>
                                                </tr>
                                            <?php } ?>
                                    </tbody>
                                <?php } else { ?>
                                    <p>Không có dữ liệu</p>
                                <?php } ?>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-text">STT</span></td>
                                        <td><span class="tfoot-text">Hình ảnh</span></td>
                                        <td><span class="tfoot-text">Tên file</span></td>
                                        <td><span class="tfoot-text">Người tạo</span></td>
                                        <td><span class="tfoot-text">Thời gian tạo</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>