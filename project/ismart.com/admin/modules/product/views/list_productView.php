<?php
get_header();
/*==========================pagging=================================*/
#Số bản ghi/trang
$num_per_page = 5;

#Tổng số bản ghi
$total_row = db_num_rows("SELECT* FROM  `tbl_product`");

#Số trang
$num_page = ceil($total_row / $num_per_page);

#chỉ số bắt đầu của trang
$page_num = (int) !empty($_GET['page']) ? $_GET['page'] : 1;
$start = ($page_num - 1) * $num_per_page;
$order_num = $start;

$list_product = get_product($start, $num_per_page);

//product đã phê duyệt
$total_approved = db_num_rows("SELECT* FROM  `tbl_product` Where `status`= 'Approved'");
//page chờ xét duyệt
$total_waiting = db_num_rows("SELECT* FROM  `tbl_product` Where `status`= 'Waitting...'");
//page trash
$total_strash = db_num_rows("SELECT* FROM  `tbl_product` Where `status`= 'Trash'");
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?mod=product&action=add_product" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo $total_row ?>)</span></a> |</li>
                            <li class="publish"><a href="">Đã phê duyệt <span class="count">(<?php echo $total_approved ?>)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt <span class="count">(<?php echo $total_waiting ?>)</span></a></li>
                            <li class="trash"><a href="">Thùng rác <span class="count">(<?php echo $total_strash ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="product">
                            <input type="hidden" name="controller" value="index">
                            <input type="hidden" name="action" value="search_page">
                            <input type="text" name="value" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                            <?php echo form_error("search"); ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=product&action=apply_page&page=<?php echo $page_num; ?>">
                        <div class="actions">
                            <div class="form-actions">
                                <select name="actions">
                                    <option value="0">Tác vụ</option>
                                    <option <?php if (isset($_POST['actions'])  && $_POST['actions'] == '1') echo "selected='selected'"; ?> value="1">Phê duyệt</option>
                                    <option <?php if (isset($_POST['actions'])  && $_POST['actions'] == '2') echo "selected='selected'"; ?> value="2">Chờ duyện</option>
                                    <option <?php if (isset($_POST['actions'])  && $_POST['actions'] == '3') echo "selected='selected'"; ?> value="3">Bỏ vào thùng rác</option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng">
                                <?php echo form_error("select"); ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Mã sản phẩm</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tên sản phẩm</span></td>
                                        <td><span class="thead-text">Giá</span></td>
                                        <td><span class="thead-text">Danh mục</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                        <td><span class="thead-text">Người sửa</span></td>
                                        <td><span class="thead-text">Thời gian sửa</span></td>
                                    </tr>
                                </thead>
                                <?php if (!empty($list_product)) { ?>
                                    <tbody>
                                        <?php $num_order = 0;
                                        foreach ($list_product as $item) {
                                            $num_order++; ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" value="<?php echo $item['product_id']; ?>" class="checkItem"></td>
                                                <td><span class="tbody-text"><?php echo $num_order; ?></h3></span>
                                                <td><span class="tbody-text"><?php echo $item['product_code'] ?></h3></span>
                                                <td>
                                                    <div class="tbody-thumb">
                                                        <img src="<?php if (!empty($item['images'])) {
                                                                        echo $item['images'];
                                                                    } else {
                                                                        echo "public/images/files/product/img-thumb.png";
                                                                    } ?>" alt="">
                                                    </div>
                                                </td>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="" title=""><?php echo $item['product_name'] ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=product&action=update_product&id_product=<?php echo $item['product_id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=product&action=delete_product&id_product=<?php echo $item['product_id']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo currency_format($item['price_new']); ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['parent_cat'] ?></span></td>
                                                <td><span class="tbody-text <?php text_color_status($item['status']); ?>"><?php echo $item['status'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['creator'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['date'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['editor'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['edit_date'] ?></span></td>
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
                                        <td><span class="tfoot-text">Mã sản phẩm</span></td>
                                        <td><span class="tfoot-text">Hình ảnh</span></td>
                                        <td><span class="tfoot-text">Tên sản phẩm</span></td>
                                        <td><span class="tfoot-text">Giá</span></td>
                                        <td><span class="tfoot-text">Danh mục</span></td>
                                        <td><span class="tfoot-text">Trạng thái</span></td>
                                        <td><span class="tfoot-text">Người tạo</span></td>
                                        <td><span class="tfoot-text">Thời gian</span></td>
                                        <td><span class="thead-text">Người sửa</span></td>
                                        <td><span class="thead-text">Thời gian sửa</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging-product" class="fl-right">
                        <?php
                        echo get_pagging($num_page, $page_num, "?mod=product");
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>