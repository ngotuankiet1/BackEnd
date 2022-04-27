<?php
get_header();
/*==========================pagging=================================*/
#Số bản ghi/trang
$num_per_page = 5;

if (!empty($_GET['value'])) {
    $value = $_GET['value'];
}

#Tổng số bản ghi
$list_all = db_search_all_slider($value);
$total_row = count($list_all);


#Số trang
$num_page = ceil($total_row / $num_per_page);

#chỉ số bắt đầu của trang
$page_num = (int) !empty($_GET['page']) ? $_GET['page'] : 1;
$start = ($page_num - 1) * $num_per_page;
$order_num = $start;

$list_slider = get_slider($start, $num_per_page, "CONVERT(`slider_link` USING utf8) LIKE '%{$value}%' OR  CONVERT(`num_order` USING utf8) LIKE '%{$value}%'");

//product đã phê duyệt
$total_approved = db_num_rows("SELECT* FROM `tbl_slider` Where `status`= 'Approved' AND CONVERT(`slider_link` USING utf8) LIKE '%{$value}%' OR  CONVERT(`num_order` USING utf8) LIKE '%{$value}%'");
//page chờ xét duyệt
$total_waiting = db_num_rows("SELECT* FROM `tbl_slider` Where `status`= 'Waitting...' AND CONVERT(`slider_link` USING utf8) LIKE '%{$value}%' OR  CONVERT(`num_order` USING utf8) LIKE '%{$value}%'");
//page trash
$total_strash = db_num_rows("SELECT* FROM `tbl_slider` Where `status`= 'Trash' AND CONVERT(`slider_link` USING utf8) LIKE '%{$value}%' OR  CONVERT(`num_order` USING utf8) LIKE '%{$value}%'");
?>
<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách slider</h3>
                    <a href="?mod=slider&action=add_slider" title="" id="add-new" class="fl-left">Thêm mới</a>
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
                            <input type="hidden" name="mod" value="slider">
                            <input type="hidden" name="controller" value="index">
                            <input type="hidden" name="action" value="search_page">
                            <input type="text" name="value" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                            <?php echo form_error("search"); ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=slider&action=apply_page&value=<?php echo $value; ?>&page=<?php echo $page_num; ?>">
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
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Link</span></td>
                                        <td><span class="thead-text">Thứ tự</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <?php if (!empty($list_slider)) { ?>
                                    <tbody>
                                        <?php $order = 0;
                                        foreach ($list_slider as $item) {
                                            $order++; ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" value="<?php echo $item['slider_id'] ?>" class="checkItem"></td>
                                                <td><span class="tbody-text"><?php echo $order ?></h3></span>
                                                <td>
                                                    <div class="tbody-thumb">
                                                        <img src="<?php if (!empty($item['images_slider'])) {
                                                                        echo $item['images_slider'];
                                                                    } else {
                                                                        echo "public/images/files/slider/img-thumb.png";
                                                                    } ?>" alt="">
                                                    </div>
                                                </td>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="" title=""><?php echo $item['slider_link'] ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=slider&action=update_slider&slider_id=<?php echo $item['slider_id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=slider&action=delete_slider&slider_id=<?php echo $item['slider_id'];; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $item['num_order'] ?></span></td>
                                                <td><span class="tbody-text <?php text_color_status($item['status']); ?>"><?php echo $item['status'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['creator'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['date'] ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                <?php } else { ?>
                                    <p>Không có dữ liệu</p>
                                <?php } ?>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging-slider" class="fl-right">
                        <?php
                        echo get_pagging($num_page, $page_num, "?mod=slider&action=result_search&value=$value");
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>