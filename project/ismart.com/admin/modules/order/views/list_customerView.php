<?php
get_header();
$get_list_customer = db_fetch_array("select * from `tbl_customers`");
#Số bản ghi/trang
$num_per_page = 10;

#Tổng số bản ghi
$total_row = count($get_list_customer);

#Số trang
$num_page = ceil($total_row / $num_per_page);

#chỉ số bắt đầu của trang
$page_num = (int) !empty($_GET['page']) ? $_GET['page'] : 1;
$start = ($page_num - 1) * $num_per_page;
$order_num = $start;

$list_customer_page = array_slice($get_list_customer, $start, $num_per_page);
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo count($get_list_customer) ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="order">
                            <input type="hidden" name="controller" value="customer">
                            <input type="hidden" name="action" value="search">
                            <input type="text" name="value"  id="s" value="<?php echo set_value('value')?>">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                            <?php echo form_error('search'); ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=order&controller=customer&action=apply_customer&page=<?php echo $page_num; ?>">
                        <div class="actions">
                            <div class="form-actions">
                                <select name="actions">
                                    <option value="0">Tác vụ</option>
                                    <option <?php if (isset($_POST['actions']) && $_POST['actions'] == '1') echo "selected = 'selected'" ?> value="1">Xóa</option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng">
                                <?php echo form_error('select'); ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Họ và tên</span></td>
                                        <td><span class="thead-text">Số điện thoại</span></td>
                                        <td><span class="thead-text">Email</span></td>
                                        <td><span class="thead-text">Địa chỉ</span></td>
                                        <td><span class="thead-text">Đơn hàng</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <?php if (!empty($list_customer_page)) { ?>
                                    <tbody>
                                        <?php $number = 1;
                                        foreach ($list_customer_page as $customer) {
                                            $number++;
                                            $order = db_fetch_row("select * from `tbl_order` where `num_phone` = '{$customer['phone']}'");
                                        ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" value="<?php echo $customer['customer_id'] ?>" class="checkItem"></td>
                                                <td><span class="tbody-text"><?php echo $number; ?></h3></span>
                                                <td>
                                                    <div class="tb-title fl-left">
                                                        <a href="" title=""><?php echo $customer['fullname']; ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=order&controller=customer&action=delete&customer_id=<?php echo $customer['customer_id'] ?>" title="Xóa" class="delete" &customer_id=<?php echo $customer['customer_id'] ?>><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $customer['phone']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $customer['email']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $customer['address']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $order['num_order']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $customer['create_date']; ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                <?php } else { ?>
                                    <p>không có dữ liệu</p>
                                <?php } ?>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-body">STT</span></td>
                                        <td><span class="tfoot-body">Họ và tên</span></td>
                                        <td><span class="tfoot-body">Số điện thoại</span></td>
                                        <td><span class="tfoot-body">Email</span></td>
                                        <td><span class="tfoot-body">Địa chỉ</span></td>
                                        <td><span class="tfoot-body">Đơn hàng</span></td>
                                        <td><span class="tfoot-body">Thời gian</span></td>
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
                        echo get_pagging($num_page, $page_num, "?mod=order&controller=customer&action=customer");
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>