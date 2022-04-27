<?php get_header();  ?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&controller=team&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">ĐĂNG KÍ TÀI KHOẢN</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <div id="sidebar" class="fl-left">
            <ul id="list-cat">
                <li>
                    <a href="?mod=users&action=change_pass" title="">Đổi mật khẩu</a>
                </li>
                <li>
                    <a href="?mod=users&action=logout" title="">Thoát</a>
                </li>
            </ul>
        </div>
        <div id="content" class="fl-right">
            <div class="section" id="detail-add-admin">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <?php echo form_error("admin") ?>
                        <label for="fullname">Tên hiển thị</label>
                        <input type="text" name="fullname" id="display-name" value="<?php echo set_value('fullname'); ?>">
                        <?php echo form_error("fullname") ?>
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username-admin" value="<?php echo set_value('username') ?>">
                        <?php echo form_error('username') ?>
                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" id="password">
                        <?php echo form_error("password") ?>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo set_value("email") ?>">
                        <?php echo form_error("email") ?>
                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="tel" id="tel" value="<?php echo set_value("tel") ?>">
                        <?php echo form_error("tel") ?>
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"><?php echo set_value("address") ?></textarea>
                        <?php echo form_error("address") ?>
                        <label for="uploadFile">Ảnh đại diện</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="upload-image" src="public/images/files/users/<?php if (isset($_FILES) && !empty($_FILES['file']['name'])) {
                                                                                        echo $_FILES['file']['name'];
                                                                                    } else {
                                                                                        echo "img-thumb.png";
                                                                                    } ?>">
                        </div>  
                        <?php echo form_error("upload_image") ?>
                        <label for="role">Phân quyền</label>
                        <select name="role" id="role">
                            <option value="">--Chọn--</option>
                            <option <?php if (isset($_POST['role'])  && $_POST['role'] == '1') echo "selected='selected'"; ?> value="1">1</option>
                            <option <?php if (isset($_POST['role'])  && $_POST['role'] == '2') echo "selected='selected'"; ?> value="2">2</option>
                            <option <?php if (isset($_POST['role'])  && $_POST['role'] == '3') echo "selected='selected'"; ?> value="3">3</option>
                        </select>
                        <?php echo form_error("role") ?>
                        <button type="submit" name="btn-add-admin" id="btn-submit">Đăng kí</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>