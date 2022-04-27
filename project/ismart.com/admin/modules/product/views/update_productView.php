<?php
get_header();
if (!empty($_GET['id_product'])) {
    $product_id = $_GET['id_product'];
    $item = get_product_by_id($product_id);
}
$data = get_cat_product();
$parent_cat = db_fetch_array("select * from `tbl_product_cat` where `cat_parent` = '0'");
$list_brands  = db_fetch_array("select DISTINCT `select_brand` from `tbl_product` where `parent_cat` = '{$item['parent_cat']}'");
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <?php echo form_error("success"); ?>
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name" value="<?php echo $item['product_name']; ?>">
                        <?php echo form_error("product_name"); ?>
                        <label for="product-code">Mã sản phẩm</label>
                        <input type="text" name="product_code" id="product-code" value="<?php echo $item['product_code']; ?>">
                        <?php echo form_error("product_code"); ?>
                        <label for="product-slug">Slug</label>
                        <input type="text" name="product_slug" id="product-slug" value="<?php echo $item['slug']; ?>">
                        <?php echo form_error("product_slug"); ?>
                        <label for="price_new">Giá sản phẩm (Mới)</label>
                        <input type="text" name="price_new" id="price_new" value="<?php echo $item['price_new'];; ?>">
                        <?php echo form_error("price_new"); ?>
                        <label for="price_old">Giá cũ</label>
                        <input type="text" name="price_old" id="price_old" value="<?php echo $item['price_old']; ?>">
                        <?php echo form_error("price_old"); ?>
                        <label for="num_product">Số lượng</label>
                        <input type="text" name="num_product" id="num_product" value="<?php echo $item['num_product']; ?>">
                        <?php echo form_error("num_product"); ?>
                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="desc" id="desc"><?php echo $item['product_desc']; ?></textarea>
                        <?php echo form_error("desc"); ?>
                        <label for="desc">Chi tiết</label>
                        <textarea name="content" id="desc" class="ckeditor"><?php echo $item['product_content'];; ?></textarea>
                        <?php echo form_error("content"); ?>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="upload-image" src="<?php if (!empty($item['images'])) {
                                                            echo $item['images'];
                                                        } else {
                                                            echo "public/images/files/product/img-thumb.png";
                                                        } ?>">
                        </div>
                        <?php echo form_error("file"); ?>
                        <label>Danh mục sản phẩm</label>
                        <select name="parent_cat" class="select-parent-cat">
                            <option value="0">Chọn danh mục</option>
                            <?php if (!empty($parent_cat)) foreach ($parent_cat as $cat) { ?>
                                <option <?php if (!empty($item['parent_cat']) && $item['parent_cat'] == $cat['title']) echo "selected='selected'" ?> value="<?php echo $cat['title'] ?>"><?php echo $cat['title'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error("parent_cat"); ?>

                        <label>Thương thiệu</label>
                        <select name="brand" class="select-brand">
                            <option value="">-- Chọn danh mục --</option>
                            <?php if (!empty($list_brands)) foreach ($list_brands as $brand) { ?>
                                <option <?php if (!empty($item['select_brand']) && $item['select_brand'] == $brand['select_brand']) echo "selected='selected'" ?> value="<?php echo $brand['select_brand'] ?>"><?php echo $brand['select_brand']; ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error("brand"); ?>

                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="0">-- Chọn danh mục --</option>
                            <option <?php if (isset($_POST['status']) && $_POST['status'] == "Waitting...") echo "selected='selected'" ?> value="Waitting...">Chờ duyệt</option>
                            <option <?php if (isset($_POST['status']) && $_POST['status'] == "Approved") echo "selected='selected'" ?> value="Approved">Phê duyệt</option>
                        </select>
                        <?php echo form_error("status"); ?>
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>