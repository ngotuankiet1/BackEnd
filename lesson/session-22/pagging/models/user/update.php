<?php
get_header();
$id = $_GET['id'];
?>
<?php
if (!empty($_POST['btn_update'])) {
    $error = array();
    $alert = array();
    if (!empty($_POST['fullname'])) {
        $fullname = $_POST['fullname'];
    } else {
        $error['fullname'] = "Không được để trống fullname";
    }
    if (!empty($_POST['gender'])) {
        $gender = $_POST['gender'];
    } else {
        $error['gender'] = "Không được để trống gender";
    }

    if (empty($error)) {
//        $sql = "update `tbl_user` set `fullname`='{$fullname}' , `gender` = '{$gender}' where `id` = {$id}";
//        if (mysqli_query($conn, $sql)) {
//            $alert['success'] = "update thành công";
//        } else {
//            echo 'update không thành công' . mysqli_error($conn);
//        }
        $data = array(
            'fullname' => $fullname,
            'gender' => $gender,
        );
        db_update("tbl_user", $data, "`id` = {$id}");
    }
}

$item = db_fetch_row("select * from `tbl_user` where `id` = {$id}");
//$sql = "select * from tbl_user where `id` = {$id}";
//$result = mysqli_query($conn, $sql);
//$item = mysqli_fetch_assoc($result);
//    show_array($item);
?>
<style>
    .succsess{
        color: red;
    }
</style>
<div id="content">
    <p>Thêm thành viên</p>
    <?php
    if (!empty($alert['success'])) {
        ?>
        <p class="succsess"><?php echo $alert['success']; ?></p>
    <?php } ?>
    <form method="POST">
        <label for="fullname">Fullname</label><br>
        <input type="text" id="fullname" name="fullname" value="<?php if (!empty($item['fullname'])) echo $item['fullname']; ?>"/><br>
        <?php echo form_error('fullname'); ?>
        <label for="gender">Gender</label><br>
        <select id="gender" name="gender">
            <option value="">--Chọn giới tính--</option>
            <option <?php if (isset($item['gender']) && $item['gender'] == 'male') echo "selected='selected'"; ?> value="male">male</option>
            <option <?php if (isset($item['gender']) && $item['gender'] == 'female') echo "selected='selected'"; ?> value="female">female</option>
        </select>
        <?php echo form_error('gender'); ?>
        <br><br>
        <input type="submit" name="btn_update" value="update">
    </form>
</div>
<?php get_footer(); ?>

