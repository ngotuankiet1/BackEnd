<?php
get_header();
$list_province = db_fetch_array("select * from `tbl_province`");
$get_cart = get_product_cart();
$total = get_total_cart();
// show_array($get_cart);   
?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form method="POST" action="dat-hang.html" name="form-checkout">
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <?php echo form_error('info'); ?>
                <?php echo form_error('success'); ?>
                <div class="section-detail">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname" value="<?php echo set_value("fullname"); ?>">
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?php echo set_value("email"); ?>">
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone" value="<?php echo set_value("phone"); ?>">
                            <?php echo form_error('phone') ?>
                        </div>
                    </div>
                    <div class="form-row clearfix">

                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <label for="province">Tỉnh/Thành Phố</label>
                            <select name="province" class="province">
                                <option value="">-Chọn Tỉnh/Thành phố-</option>
                                <?php if (!empty($list_province)) foreach ($list_province as $province) { ?>
                                    <option <?php if (isset($_POST['province']) && $_POST['province'] == $province['name']) echo "selected = 'selected'" ?> value="<?php echo $province['name']; ?>">-<?php echo $province['name']; ?>-</option>
                                <?php } ?>
                            </select>

                            <label for="district">Quận/Huyện</label>
                            <select name="district" class="district">
                                <option value="">-Chọn Quận/Huyện-</option>
                            </select>

                            <label for="commune">Xã/Phường</label>
                            <select name="commune" class="commune">
                                <option value="">-Chọn Xã/Phường-</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea rows="10" cols="75" name="note" placeholder="ghi gõ thông tin đại chỉ"><?php echo set_value("note"); ?></textarea>
                        </div>
                    </div>

                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <?php if (!empty($get_cart)) { ?>
                            <tbody>
                                <?php foreach ($get_cart as $item) { ?>
                                    <tr class="cart-item">
                                        <td class="product-name"><?php echo $item['product_name'] ?><strong class="product-quantity">x <?php echo $item['qty'] ?></strong></td>
                                        <td class="product-total"><?php echo currency_format($item['sud_total']); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        <?php } ?>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price"><?php echo currency_format($total); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment_method" value="direct-payment">
                                <label for="direct-payment">Thanh toán tại cửa hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment_method" value="payment-home">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                        </ul>
                        <?php echo form_error('payment_method'); ?>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" name="btn_order" id="order-now" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php get_footer(); ?>