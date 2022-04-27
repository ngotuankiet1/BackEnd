<?php
get_header();

if (isset($_GET['value'])) {
    $value = $_GET['value'];
}

$list_order = db_fetch_array("SELECT * FROM `tbl_order` WHERE CONVERT(`fullname` USING utf8) LIKE '%{$value}%' OR `order_code` LIKE '%{$value}%'");
#Số bản ghi/trang
$num_per_page = 5;

#Tổng số bản ghi
$total_row = count($list_order);

#Số trang
$num_page = ceil($total_row / $num_per_page);

#chỉ số bắt đầu của trang
$page_num = (int) !empty($_GET['page']) ? $_GET['page'] : 1;
$start = ($page_num - 1) * $num_per_page;
$order_num = $start;

$list_customer_page = array_slice($list_order, $start, $num_per_page);
/*=========================================================*/
//page đã phê duyệt
$total_approved = db_num_rows("SELECT* FROM  `tbl_order` Where `order_status`= 'Approved'");
//page chờ xét duyệt
$total_waiting = db_num_rows("SELECT* FROM  `tbl_order` Where `order_status`= 'Waitting...'");
//page trash
$total_strash = db_num_rows("SELECT* FROM  `tbl_order` Where `order_status`= 'Trash'");
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
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
                            <input type="hidden" name="mod" value="order" id="s">
                            <input type="hidden" name="controller" value="index" id="s">
                            <input type="hidden" name="action" value="search" id="s">
                            <input type="text" name="value" value="<?php echo set_value("value"); ?>" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                            <?php echo form_error("search"); ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=order&action=apply_order&page=<?php echo $num_page ?>&value=<?php echo $value; ?>">
                        <div class="actions">
                            <div action="" class="form-actions">
                                <select name="actions">
                                    <option value="0">Tác vụ</option>
                                    <option <?php if (isset($_POST['actions']) && $_POST['actions'] == '1') echo "selected = 'selected'" ?> value="1">Công khai</option>
                                    <option <?php if (isset($_POST['actions']) && $_POST['actions'] == '2') echo "selected = 'selected'" ?> value="2">Chờ duyệt</option>
                                    <option <?php if (isset($_POST['actions']) && $_POST['actions'] == '3') echo "selected = 'selected'" ?> value="3">Bỏ vào thủng rác</option>
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
                                        <td><span class="thead-text">Mã đơn hàng</span></td>
                                        <td><span class="thead-text">Họ và tên</span></td>
                                        <td><span class="thead-text">Số sản phẩm</span></td>
                                        <td><span class="thead-text">Tổng giá</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                        <td><span class="thead-text">Chi tiết</span></td>
                                    </tr>
                                </thead>
                                <?php if (!empty($list_customer_page)) { ?>
                                    <tbody>
                                        <?php $num_order = 1;
                                        foreach ($list_customer_page as $order) {
                                            $num_order++; ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" value="<?php echo $order['id_order']; ?>" class="checkItem"></td>
                                                <td><span class="tbody-text"><?php echo $num_order; ?></h3></span>
                                                <td><span class="tbody-text"><?php echo $order['order_code'] ?></h3></span>
                                                <td>
                                                    <div class="tb-title fl-left">
                                                        <a href="" title=""><?php echo $order['fullname'] ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=order&action=update_order&order_id=<?php echo $order['id_order']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=order&action=delete&order_id=<?php echo $order['id_order']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $order['num_order']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo currency_format($order['total_price']); ?></span></td>
                                                <td><span class="tbody-text <?php text_color_status($order['order_status']) ?>"><?php echo $order['order_status']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $order['create_date']; ?></span></td>
                                                <td><a href="?mod=order&action=detail" title="" class="tbody-text">Chi tiết</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                <?php } else { ?>
                                    <p>không có dữ liệu</p>
                                <?php } ?>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-text">STT</span></td>
                                        <td><span class="tfoot-text">Mã đơn hàng</span></td>
                                        <td><span class="tfoot-text">Họ và tên</span></td>
                                        <td><span class="tfoot-text">Số sản phẩm</span></td>
                                        <td><span class="tfoot-text">Tổng giá</span></td>
                                        <td><span class="tfoot-text">Trạng thái</span></td>
                                        <td><span class="tfoot-text">Thời gian</span></td>
                                        <td><span class="tfoot-text">Chi tiết</span></td>
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
                    <ul id="list-paging-customers" class="fl-right">
                        <?php
                        echo get_pagging($num_page, $page_num, "?mod=order&action=result_search");
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>