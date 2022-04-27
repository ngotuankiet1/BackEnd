<?php
get_header();
// unset($_SESSION['cart']);
$get_cart = get_product_cart();
$total = get_total_cart();
// show_array($get_cart);
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Sản phẩm làm đẹp da</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <form method="POST" action="?mod=cart&action=update_cart" class="section-detail table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <?php if (!empty($get_cart)) { ?>
                        <tbody>
                            <?php foreach ($get_cart as $item) { ?>
                                <tr>
                                    <td><?php echo $item['product_code'] ?></td>
                                    <td>
                                        <a href="chi-tiet/<?php echo $item['slug']; ?>-<?php echo $item['product_id']; ?>.html" title="" class="thumb">
                                            <img src="admin/<?php echo $item['images'] ?>" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="chi-tiet/<?php echo $item['slug']; ?>-<?php echo $item['product_id']; ?>.html" title="" class="name-product"><?php echo $item['product_name'] ?></a>
                                    </td>
                                    <td><?php echo currency_format($item['price_new']); ?></td>
                                    <td>
                                        <input type="number" min="1" max="20" name="num-order[<?php echo $item['product_id'] ?>]" data_id='<?php echo $item['product_id'] ?>' value="<?php echo $item['qty']; ?>" class="num-order">
                                    </td>
                                    <td id="total-<?php echo $item['product_id'] ?>"><?php echo currency_format($item['sud_total']); ?></td>
                                    <td>
                                        <a href="delete/<?php echo $item['slug'] ?>-<?php echo $item['product_id'] ?>-d.html" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php } else { ?>
                        <p style="font-style: italic; color: red;">không còn sản phẩm nào</p>
                    <?php } ?>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span><?php echo currency_format($total); ?></span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <input type="submit" name="update_cart" id="update-cart" value="Cập nhật giỏ hàng"></input>
                                        <a href="thanh-toan.html" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="" title="" id="buy-more">Mua tiếp</a><br />
                <a href="?mod=cart&action=delete_cart" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>