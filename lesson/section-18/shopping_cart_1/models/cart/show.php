<?php get_header(); ?>
<?php
$list_cart = get_product_cart();
$total = get_total_order_cart();
//show_array($list_cart);
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <h3 class="title">Giỏ hàng</h3>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <?php if (!empty($list_cart)) { ?>
            <div class="section" id="info-cart-wp">
                <div class="section-detail table-responsive">
                    <form action="?model=cart&act=upload" method="POST">
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
                            <tbody>
                                <?php foreach ($list_cart as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['code'] ?></td>
                                        <td>
                                            <a href="" title="" class="thumb">
                                                <?php echo $item['thumb']; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo $item['url']; ?>" title="<?php echo $item['product_title'] ?>" class="name-product"><?php echo $item['product_title'] ?></a>
                                        </td>
                                        <td><?php echo arrency_format($item['price']); ?></td>
                                        <td>
                                            <input type="number" min="1" max="10" name="qty[<?php echo $item['id'] ?>]" value="<?php echo $item['qty']; ?>" class="num-order">
                                        </td>
                                        <td><?php echo arrency_format($item['sud_total']); ?></td>
                                        <td>
                                            <a href="<?php echo $item['url_delete'] ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <p id="total-price" class="fl-right">Tổng giá: <span><?php echo arrency_format($total); ?></span></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <div class="fl-right">
                                                <input type="submit" id="update-cart" name="btn_update" value="Cập nhật giỏ hàng"/>
                                                <a href="?model=cart&act=checkout" title="" id="checkout-cart">Thanh toán</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
            <div class="section" id="action-cart-wp">
                <div class="section-detail">
                    <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                    <a href="?model=home&act=main" title="" id="buy-more">Mua tiếp</a><br/>
                    <a href="?model=cart&act=delete_all" title="" id="delete-cart">Xóa giỏ hàng</a>
                </div>
            </div>
            <?php
        } else {
            ?>
            <p>Không có sản phẩm</p>
            <?php
        }
        ?>

    </div>
</div>
<?php get_footer(); ?>
