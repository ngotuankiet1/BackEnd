<?php
get_header();
/*==========================pagging=================================*/
#Số bản ghi/trang
$num_per_page = 3;

if (!empty($_GET['value'])) {
    $value = $_GET['value'];
}

#Tổng số bản ghi
$list_pages_all = db_search_all_pages($value);
$total_row = count($list_pages_all);

#Số trang
$num_page = ceil($total_row / $num_per_page);

#chỉ số bắt đầu của trang
$page_num = (int) !empty($_GET['page']) ? $_GET['page'] : 1;
$start = ($page_num - 1) * $num_per_page;
$order_num = $start;

$list_pages = get_page($start, $num_per_page, "CONVERT(`title` USING utf8) LIKE '%{$value}%' OR `category` LIKE '%{$value}%' OR `cretor` LIKE '%{$value}%'");
/*=========================================================*/
//page đã phê duyệt
$total_approved = db_num_rows("SELECT* FROM  `tbl_page` Where `page_status`= 'Approved' AND CONVERT(`title` USING utf8) LIKE '%{$value}%' OR `category` LIKE '%{$value}%' OR `cretor` LIKE '%{$value}%'");
//page chờ xét duyệt
$total_waiting = db_num_rows("SELECT* FROM  `tbl_page` Where `page_status`= 'Waitting...' AND CONVERT(`title` USING utf8) LIKE '%{$value}%' OR `category` LIKE '%{$value}%' OR `cretor` LIKE '%{$value}%'");
//page trash
$total_strash = db_num_rows("SELECT* FROM  `tbl_page` Where `page_status`= 'Trash' AND CONVERT(`title` USING utf8) LIKE '%{$value}%' OR `category` LIKE '%{$value}%' OR `cretor` LIKE '%{$value}%'");
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách trang</h3>
                    <a href="?page=add_page" title="" id="add-new" class="fl-left">Thêm mới</a>
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
                            <input type="hidden" name="mod" value="page">
                            <input type="hidden" name="controller" value="index">
                            <input type="hidden" name="action" value="search_page">
                            <input type="text" name="value" id="s" value="<?php echo set_value("value"); ?>" placeholder="Tìm kiếm">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                            <?php echo form_error("search"); ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=page&action=apply_page&page=<?php echo $page_num; ?>&value=<?php echo $value; ?>">
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
                            <?php
                            $error = array();;
                            $order = 0;
                            if (!empty($list_pages)) {
                            ?>
                                <table class="table list-table-wp">
                                    <thead>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">STT</span></td>
                                            <td><span class="thead-text">Tiêu đề</span></td>
                                            <td><span class="thead-text">Danh mục</span></td>
                                            <td><span class="thead-text">Trạng thái</span></td>
                                            <td><span class="thead-text">Người tạo</span></td>
                                            <td><span class="thead-text">Thời gian</span></td>
                                        </tr>
                                    </thead>
                                    <?php foreach ($list_pages as $page) {
                                        $order++; ?>
                                        <tbody>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" value="<?php echo $page['id_page']; ?>" class="checkItem"></td>
                                                <td><span class="tbody-text"><?php echo $order; ?></h3></span>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="" title=""><?php echo $page['title']; ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=page&action=update_page&id_page=<?php echo $page['id_page']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=page&action=delete_page&id_page=<?php echo $page['id_page']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $page['category']; ?></span></td>
                                                <td><span class="tbody-text <?php text_color_status($page['page_status']) ?>"><?php echo $page['page_status']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $page['cretor']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $page['date']; ?></span></td>
                                            </tr>
                                        </tbody>
                                    <?php } ?>
                                </table>
                            <?php } else {
                                $error['page'] = "không có dữ liệu"; ?>
                                <p><?php echo  $error['page'] ?> </p>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <ul id="list-paging-page_num" class="fl-right">
                        <?php
                        echo get_pagging($num_page, $page_num, "?mod=page&controller=index&action= result_search&value=$value");
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>