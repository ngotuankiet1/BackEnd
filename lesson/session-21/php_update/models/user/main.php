<?php get_header(); ?>
<?php
$sql = "select * from `tbl_user`";
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    $list_user = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $list_user[] = $row;
    }
}
foreach ($list_user as &$users) {
    $users['url_update'] = "?model=user&act=update&id={$users['id']}";
    $users['url_delete'] = "?model=user&act=delete&id={$users['id']}";
}
?>
<style>
    .tbl_users tr td{
        border-bottom: 1px solid #000;
        padding: 8px 15px;
    }
</style>
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
                        <td><?php echo $user['gender'] ?></td>
                        <td><a href="<?php echo $user['url_update']; ?>">Sửa</a> | <a href="<?php echo $user['url_delete']; ?>">Xóa</a> </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
    <p class="num_rows">Có tất cả <?php echo $num_rows; ?> thành viên trong hệ thống</p>
</div>
<?php get_footer(); ?>
