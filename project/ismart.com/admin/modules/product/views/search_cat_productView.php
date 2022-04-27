<?php
get_header();
$data = get_cat_product();
$list_cat = data_tree($data, 0);
/*==========================pagging=================================*/
#Số bản ghi/trang
$num_per_page = 3;

if (!empty($_GET['value'])) {
    $value = $_GET['value'];
}

#Tổng số bản ghi
$list_cat_all = db_search_all_cat_product($value);
$total_row = count($list_cat_all);

#Số trang
$num_page = ceil($total_row / $num_per_page);

#chỉ số bắt đầu của trang
$page_num = (int) !empty($_GET['page']) ? $_GET['page'] : 1;
$start = ($page_num - 1) * $num_per_page;
$order_num = $start;

$lis_cat_product = get_cat($start, $num_per_page, "CONVERT(`title` USING utf8) LIKE '%{$value}%' OR  CONVERT(`creator` USING utf8) LIKE '%{$value}%'");
/*=========================================================*/
//page đã phê duyệt
$total_approved = db_num_rows("SELECT* FROM  `tbl_product_cat` Where `cat_status`= 'Approved' AND CONVERT(`title` USING utf8) LIKE '%{$value}%' OR  CONVERT(`creator` USING utf8) LIKE '%{$value}%'");
//page chờ xét duyệt
$total_waiting = db_num_rows("SELECT* FROM  `tbl_product_cat` Where `cat_status`= 'Waitting...' AND CONVERT(`title` USING utf8) LIKE '%{$value}%' OR  CONVERT(`creator` USING utf8) LIKE '%{$value}%'");
//page trash
$total_strash = db_num_rows("SELECT* FROM  `tbl_product_cat` Where `cat_status`= 'Trash' AND CONVERT(`title` USING utf8) LIKE '%{$value}%' OR  CONVERT(`creator` USING utf8) LIKE '%{$value}%'");
?>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách danh mục</h3>
                    <a href="?mod=post&controller=cat&action=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
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
                            <input type="hidden" name="controller" value="cat_product">
                            <input type="hidden" name="action" value="search_page">
                            <input type="text" name="value" id="s" value="<?php echo set_value("value"); ?>" placeholder="Tìm kiếm">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                            <?php echo form_error("search"); ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=product&controller=cat_product&action=apply_page&value=<?php if(!empty($value)) echo $value; ?>&page=<?php echo $page_num; ?>">
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
                            <?php if (!empty($list_cat)) { ?>
                                <table class="table list-table-wp">
                                    <thead>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">STT</span></td>
                                            <td><span class="thead-text">Tiêu đề</span></td>
                                            <td><span class="thead-text">Thứ tự</span></td>
                                            <td><span class="thead-text">Trạng thái</span></td>
                                            <td><span class="thead-text">Người tạo</span></td>
                                            <td><span class="thead-text">Người sửa</span></td>
                                            <td><span class="thead-text">Ngày sửa</span></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $num_order = 0;
                                        foreach ($lis_cat_product as $item) {
                                            $num_order++; ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" value="<?php echo $item["cat_id"] ?>" class="checkItem"></td>
                                                <td><span class="tbody-text"><?php echo $num_order; ?></h3></span>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="" title=""><?php echo $item['title']; ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=product&controller=cat_product&action=update_cat&id_cat_product=<?php echo $item['cat_id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=product&controller=cat_product&action=delete_cat&id_cat_product=<?php echo $item['cat_id']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li </ul>
                                                </td>
                                                <td class="tbody-text"><?php echo $item['cat_parent']; ?></td>
                                                <td><span class="tbody-text <?php text_color_status($item['cat_status']); ?>"><?php echo $item['cat_status']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['date']; ?></span></td>
                                                <td><span class="tbody-text"></span></td>
                                                <td><span class="tbody-text"></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <p>không có dữ liệu</p>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging-cat-post" class="fl-right">
                        <?php
                        echo get_pagging($num_page, $page_num, "?mod=product&controller=cat_product&action=result_search&value=$value");
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>