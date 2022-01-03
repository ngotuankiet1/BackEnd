<?php get_header(); ?>
<?php
$num_rows = db_num_rows("select * from `tbl_user`");
//===========================================================================
#Số lượng bản ghi trên trang
$num_pers_page = 3;

#Tổng số bản ghi
$total_row = $num_rows;

#Số trang
$num_pages = ceil($total_row / $num_pers_page);
echo "Số trang:{$num_pages}"."<br>";

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $num_pers_page;
echo "trang: {$page}"."<br>";

$list_user = get_users($start, $num_pers_page);

foreach ($list_user as &$user) {
    $user['url_update'] = "?model=user&act=update&id={$user['id']}";
    $user['url_delete'] = "?model=user&act=delete&id={$user['id']}";
}
unset($user);
?>
<div id="content">
    <a href="?model=user&act=add" class="add_member">Thêm Thành Viên</a>
    <p>Thành viên</p>
    <?php if (!empty($list_user)) { ?>
        <table class="tbl_users">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Fullname</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>Gender</td>
                    <td>thao tác</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_user as $user) {
                    ?>
                    <tr>
                        <td><?php echo $user['id'] ?></td>
                        <td><?php echo $user['fullname'] ?></td>
                        <td><?php echo $user['username'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo show_gender($user['gender']) ?></td>
                        <td><a href="<?php echo $user['url_update']; ?>">Sửa</a> | <a href="<?php echo $user['url_delete']; ?>">Xóa</a> </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php 
        echo get_pagging($num_pages, $page, "?model=user&act=main");
        ?>
        <p class="num_rows">Có tất cả <?php echo $num_rows; ?> thành viên trong hệ thống</p>
    <?php } ?>
</div>
<?php get_footer(); ?>
