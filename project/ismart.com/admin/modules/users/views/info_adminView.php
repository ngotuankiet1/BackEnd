<?php
get_header();
$avatar = info_user('avatar');
?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&action=reg&manage=1" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar("user"); ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <?php echo form_error("success") ?>
                        <label for="display-name">Tên hiển thị</label>
                        <input type="text" name="display-name" id="display-name" value="<?php echo info_user('fullname'); ?>">
                        <?php echo form_error("display-name") ?>
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" placeholder="<?php echo info_user('username'); ?>" readonly="readonly">
                        <?php echo form_error("username") ?>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo info_user('email'); ?>">
                        <?php echo form_error("email") ?>
                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="tel" id="tel" value="<?php echo info_user('phone_number'); ?>">
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"><?php echo info_user('address'); ?></textarea>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="upload-image" src="<?php if (!empty($avatar)) {
                                                            echo $avatar;
                                                        } else {
                                                            echo "public/images/files/users/img-thumb.png";
                                                        } ?>">
                        </div>
                        <?php echo form_error("upload_image") ?>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>