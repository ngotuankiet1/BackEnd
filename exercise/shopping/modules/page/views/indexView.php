<?php get_header(); ?>
<div id="main-content-wp" class="detail-news-page">
    <div class="wp-inner clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-news-wp">
                <div class="section-head">
                    <h3 class="section-title"><?php echo $info['titile_page'] ?></h3>
                </div>
                <div class="section-detail">
                    <p class="create-date"><?php echo $info['date_page'] ?></p>
                    <div class="content-news">
                        <p>[<?php echo $info['titile_page'] ?>] <?php echo $info['content_page'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>