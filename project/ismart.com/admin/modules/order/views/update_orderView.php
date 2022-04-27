<?php
get_header();

?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <?php echo form_error("success") ?>
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?php echo info_page("title", $id_page) ?>">
                        <?php echo form_error("title") ?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo info_page("slug", $id_page) ?>">
                        <?php echo form_error("slug") ?>
                        <label for="desc">Mô tả</label>
                        <textarea name="desc" id="desc" class="ckeditor"><?php echo info_page("content_page", $id_page) ?></textarea>
                        <?php echo form_error("desc") ?>
                        <select name='category'>
                            <option value="">Danh mục</option>
                            <option <?php if (isset($category) && $category == 'Giới thiệu') echo "selected='selected'"; ?> value="Giới thiệu">Giới thiệu</option>
                            <option <?php if (isset($category) && $category == 'Liên hệ') echo "selected='selected'"; ?> value="Liên hệ">Liên hệ</option>
                        </select>
                        <?php echo form_error("category") ?>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>