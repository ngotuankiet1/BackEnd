<?php
get_header();
/*==========================pagging=================================*/
// $list_users = get_list_admins();

#Số bản ghi/trang
$num_per_page = 3;

// $list_num_page = db_num_page('tbl_admin', $num_per_page);
if (!empty($_GET['value'])) {
    $value = $_GET['value'];
}

#Tổng số bản ghi
$list_admins_all = db_search_all_admins($value);
$total_row = count($list_admins_all);

#Số trang
$num_page = ceil($total_row / $num_per_page);

#chỉ số bắt đầu của trang
$page = (int) !empty($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $num_per_page;
$order_num = $start;

$list_admins = db_search_admins_by_page($value, $start, $num_per_page, "`username` LIKE '%{$value}%' OR `fullname` LIKE '%{$value}%' OR `fullname` LIKE '%{$value}%' OR `email` LIKE '%{$value}%'");
/*=========================================================*/
//admin đã phê duyệt
$admin_approved = db_num_rows("SELECT* FROM  `tbl_admin` Where `admin_status`= 'Approved'");
//admin chờ xét duyệt
$admin_waiting = db_num_rows("SELECT* FROM  `tbl_admin` Where `admin_status`= 'Waitting...'");
//admin trash
$admin_strash = db_num_rows("SELECT* FROM  `tbl_admin` Where `admin_status`= 'Trash'");
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <div class="section" id="title-page">
            <div class="clearfix">
                <?php if (is_login() && check_role($_SESSION['users_login']) == 1) { ?>
                    <a href="?mod=users&controller=team&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                    <h3 id="index" class="fl-left">Nhóm quản trị</h3>
                <?php } else { ?>
                    <h3 style="margin-left: 5%;" id="index" class="fl-left">Nhóm quản trị</h3>
                <?php } ?>
            </div>
        </div>
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo $total_row ?>)</span></a> |</li>
                            <li class="publish"><a href="">Đã phê duyệt <span class="count">(<?php echo $admin_approved ?>)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt <span class="count">(<?php echo $admin_waiting ?>)</span></a></li>
                            <li class="trash"><a href="">Thùng rác <span class="count">(<?php echo $admin_strash ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="users">
                            <input type="hidden" name="controller" value="team">
                            <input type="hidden" name="action" value="search_admin">
                            <input type="text" name="value" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm" placeholder="Tìm kiếm">
                            <?php echo form_error("search"); ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=users&controller=team&action=apply_admins&page=<?php echo $page; ?>&value=<?php if(!empty($value)) echo $value; ?>">
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
                                        <td><span class="thead-text">Ảnh đại diện</span></td>
                                        <td><span class="thead-text">Tên đăng nhập</span></td>
                                        <td><span class="thead-text">Họ tên</span></td>
                                        <td><span class="thead-text">Email</span></td>
                                        <td><span class="thead-text">Số điện thoại</span></td>
                                        <td><span class="thead-text">Địa chỉ</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Hoạt động</span></td>
                                        <td><span class="thead-text">Ngày đăng kí</span></td>
                                        <td><span class="thead-text">Phân quyền</span></td>
                                    </tr>
                                </thead>
                                <?php if (!empty($list_admins)) {
                                    $error = array();
                                    $order = 0;
                                ?>
                                    <tbody>
                                        <?php
                                        foreach ($list_admins as $admin) {
                                            $order++;
                                            // show_array($admin);
                                        ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $admin['id'] ?>"></td>
                                                <td><span class="tbody-text">
                                                        <h3><?php echo $order; ?></h3>
                                                    </span>
                                                <td>
                                                    <div class="tbody-thumb">
                                                        <img src="<?php if (!empty($admin['avatar'])) {
                                                                        echo $admin['avatar'];
                                                                    } else {
                                                                        echo "public/images/files/users/img-thumb.png";
                                                                    } ?>">
                                                    </div>
                                                </td>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <span class="tbody-text"><?php echo $admin['username']; ?></span>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=users&controller=team&action=update_admin&id=<?php echo $admin['id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=users&controller=team&action=delete&id=<?php echo $admin['id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $admin["fullname"]; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $admin["email"]; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $admin["phone_number"]; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $admin["address"]; ?></span></td>
                                                <td><span class="tbody-text <?php text_color_status($admin["admin_status"]) ?>"><?php echo $admin["admin_status"]; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $admin["active"]; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $admin["reg_date"]; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $admin["role"]; ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                <?php
                                } else {
                                    $error['admin'] = "Không có admin nào!";
                                ?>
                                    <p class="error"><?php echo  $error['admin'] ?> </p>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <?php
                    echo get_pagging($num_page, $page, "?mod=users&controller=team&action=result_search&value={$value}") ;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>