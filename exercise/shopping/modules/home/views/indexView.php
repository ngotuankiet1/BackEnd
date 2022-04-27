<?php get_header(); ?>
<div id="main-content-wp" class="home-page">
    <div class="wp-inner clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section list-cat">
                <div class="section-head">
                    <h3 class="section-title"><a href="<?php echo $cat_phone['url']; ?>"><?php echo $cat_phone['cat_title']; ?></a></h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php foreach ($get_phone as $item) { ?>
                            <li>
                                <a href="<?php echo $item['url_product']; ?>" title="" class="thumb">
                                    <?php echo $item['product_thump']; ?>
                                </a>
                                <a href="<?php echo $item['url_product']; ?>" title="" class="title"><?php echo $item['name_product'] ?></a>
                                <p class="price"><?php echo currency_format($item['price']); ?></p>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="section list-cat">
                <div class="section-head">
                    <h3 class="section-title"><a href="<?php echo $cat_macbook['url']; ?>"><?php echo $cat_macbook['cat_title']; ?></a></h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php foreach ($get_macbook as $item) { ?>
                            <li>
                                <a href="<?php echo $item['url_product']; ?>" title="" class="thumb">
                                    <?php echo $item['product_thump']; ?>
                                </a>
                                <a href="<?php echo $item['url_product']; ?>" title="" class="title"><?php echo $item['name_product'] ?></a>
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