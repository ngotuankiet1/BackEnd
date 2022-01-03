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
        $sql = "update `tbl_user` set `fullname`='{$fullname}',`gender`='{$gender}' where `id`={$id}";
        if (mysqli_query($conn, $sql)) {
            $alert['success'] = "update thành công";
        } else {
            echo 'update không thành công' . mysqli_error($conn);
        }
    }
}
#để dưới này để khi update vào database thì có thể lấy dữ liệu đưa vào form
$sql = "select * from tbl_user where `id` = {$id}";
$result = mysqli_query($conn, $sql);
$item = mysqli_fetch_assoc($result);
//show_array($item);   
?>
<div id="content">
    <style>
        .res_form{
            width: 250px;
        }
        input[type='text']{
            display: block;
            width: 100%;
            padding: 4px 10px;
        }
        input[type='submit']{
            margin-top:20px; 
            padding: 4px 10px;
            display: block;
            width: 100%;
            background: #FFA54E;
            text-align: center;
            font-weight: bold;
        }
        #gender{
            display: block;
            width: 100%;
            padding: 4px 10px;
        }
        .succsess{
            color: red;
        }
    </style>
    <p>update member</p>
    <?php
    if (!empty($alert['success'])) {
        ?>
        <p class="succsess"><?php echo $alert['success']; ?></p>
    <?php } ?>
    <form class="res_form" method="POST">
        <label for="fullname">Fullname</label><br>
        <input type="text" id="fullname" name="fullname" value="<?php if (!empty($item['fullname'])) echo $item['fullname']; ?>"/>
        <?php echo form_error('fullname'); ?>
        <label for="gender">Gender</label>
        <select id="gender" name="gender">
            <option value="">--Chọn giới tính--</option>
            <option <?php if (isset($item['gender']) && $item['gender'] == 'male') echo "selected='selected'"; ?> value="male">male</option>
            <option <?php if (isset($item['gender']) && $item['gender'] == 'female') echo "selected='selected'"; ?> value="female">female</option>
        </select>
        <?php echo form_error('gender'); ?>
        <input type="submit" name="btn_update" value="update">
    </form>
</div>
<?php
get_footer();
?>
