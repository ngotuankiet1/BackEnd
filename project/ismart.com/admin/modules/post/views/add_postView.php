<?php
get_header();
$data = get_post_cat();
$list_cat = data_tree($data, 0);
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form enctype="multipart/form-data" method="POST">
                        <?php echo form_error('post') ?>
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?php echo set_value("title") ?>">
                        <?php echo form_error('title') ?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo set_value("slug") ?>">
                        <?php echo form_error('slug') ?>
                        <label for="desc">Nội dung bài viết</label>
                        <textarea name="desc" id="desc" class="ckeditor"> <?php echo set_value("desc") ?> </textarea>
                        <?php echo form_error('desc') ?>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="upload-image" src="public/images/files/posts/<?php if (isset($_FILES) && !empty($_FILES['file']['name'])) {
                                                                                        echo $_FILES['file']['name'];
                                                                                    } else {
                                                                                        echo "img-thumb.png";
                                                                                    } ?>">
                        </div>
                        <?php echo form_error('upload_image'); ?>
                        <label>Danh mục cha</label>
                        <select name="parent_cat">
                            <option <?php if (!empty($_POST['parent_cat']) && $_POST['parent_cat'] == 0) echo "selected='selected'" ?> value="0">Chọn danh mục</option>
                            <?php foreach ($list_cat as $cat) { ?>
                                <option <?php if (!empty($_POST['parent_cat']) && $_POST['parent_cat'] == $cat['cat_id']) echo "selected='selected'" ?> value="<?php echo $cat['cat_id'] ?>"> <?php echo str_repeat('--', $cat['lever']) . ' ' . $cat['title']; ?> </option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('parent_cat') ?>
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>