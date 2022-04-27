<?php
get_header();
if (isset($_GET['menu_id'])) {
    $menu_id = $_GET['menu_id'];
    $title = get_info_menu('title', $menu_id);
}
?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title=""><?php echo get_info_page('title', $title); ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo get_info_page('title', $title); ?></h3>
                </div>
                <div class="section-detail">
                    <span class="create-date"><?php echo get_info_page('date', $title); ?></span>
                    <div class="detail"><?php echo get_info_page('content_page', $title); ?></div>
                </div>
            </div>
            <div class="face" style="margin-top: 20px;">
                <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=120&layout=button&action=like&size=small&share=true&height=65&appId" width="120" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>