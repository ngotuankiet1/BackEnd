<?php
get_header();
//show_array($phone);
?>
<div id="main-content-wp" class="home-page">
    <div class="wp-inner clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section list-cat">
                <div class="section-head">
                    <h3 class="section-title"><?php echo $phone['cat_title'] ?></h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php foreach ($list_phone as $item){ ?>
                        <li>
                            <a href="<?php echo $item['url_product']; ?>" title="" class="thumb">
                                <?php echo $item['product-thump']; ?>
                            </a>
                            <a href="<?php echo $item['url_product'] ?>" title="" class="title"><?php echo $item['name_product']; ?></a>
                            <p class="price"><?php echo currency_format($item['price']); ?></p>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="section list-cat">
                <div class="section-head">
                    <h3 class="section-title"><?php echo $laptop['cat_title'] ?></h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php foreach ($list_laptop as $item){ ?>
                        <li>
                            <a href="<?php echo $item['url_product']; ?>" title="" class="thumb">
                                <?php echo $item['product-thump']; ?>
                            </a>
                            <a href="<?php echo $item['url_product'] ?>" title="" class="title"><?php echo $item['name_product']; ?></a>
                            <p class="price"><?php echo currency_format($item['price']); ?></p>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>