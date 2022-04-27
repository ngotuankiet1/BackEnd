<?php
get_header();
if (!empty($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $get_post = db_fetch_row("select * from `tbl_post` where `id` = '{$post_id}'");
}
$list_post = db_fetch_array("select * from `tbl_post` where `post_status` = 'Approved'");

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
                        <a href="" title=""><?php echo $_GET['mod']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo $get_post['post_title']; ?></h3>
                </div>
                <div class="section-detail">
                    <span class="create-date"><?php echo $get_post['date']; ?></span>
                    <div class="detail">
                        <?php echo $get_post['post_content']; ?>
                    </div>
                </div>
                <div class="face" style="margin-top: 20px;">
                    <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=120&layout=button&action=like&size=small&share=true&height=65&appId" width="120" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                </div>
            </div>
            <!-- <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php if (!empty($list_post_page)) echo get_paggings($num_page, $page_num); ?>
                    </ul>
                </div>
            </div> -->
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>