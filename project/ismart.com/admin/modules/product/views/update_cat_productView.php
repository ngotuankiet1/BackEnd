<?php
get_header();
$data = get_cat_product();
$list_product = data_tree($data, 0);
$id = $_GET['id_cat_product'];
$item = get_product_cat_by_id($id);
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <?php echo form_error("success") ?>
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?php echo $item['title']; ?>">
                        <?php echo form_error("title") ?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo $item['slug']; ?>">
                        <?php echo form_error("slug"); ?>
                        <label>Danh mục cha</label>
                        <select name="parent_cat">
                            <option <?php if (!empty($_POST['parent_cat']) && $_POST['parent_cat'] == 0) echo "selected='selected'" ?> value="0">Chọn danh mục</option>
                            <?php foreach ($list_product as $cat) { ?>
                                <option <?php if (!empty($item['cat_parent']) && $item['cat_parent'] == $cat['cat_id']) echo "selected='selected'" ?> value="<?php echo $cat['cat_id'];  ?>"> <?php echo str_repeat('--', $cat['lever']) . ' ' . $cat['title']; ?> </option>
                            <?php } ?>
                        </select>
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>