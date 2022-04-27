<?php
get_header();
$list_post = db_fetch_array("select * from `tbl_post` where `post_status` = 'Approved'");

if (!empty($list_post)) {
    $num_per_page = 2;

    $total_post = count($list_post);

    $num_page = ceil($total_post / $num_per_page);

    $page_num = 1;
    $start = ($page_num - 1) * $num_per_page;

    $list_post_page = array_slice($list_post, $start, $num_per_page);
} else {
    $page_num = 1;
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
                        <a href="" title=""><?php echo $_GET['mod']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo $_GET['mod']; ?></h3>
                </div>
                <div id="blog">
                    <div class="section-detail">
                        <?php if (!empty($list_post_page)) { ?>
                            <ul class="list-item">
                                <?php foreach ($list_post_page as $post) { ?>
                                    <li class="clearfix">
                                        <a href="bai-viet/<?php echo $post['slug']; ?>-<?php echo $post['id'] ?>.html" title="" class="thumb fl-left">
                                            <img src="admin/<?php echo $post['images']; ?>" alt="">
                                        </a>
                                        <div class="info fl-right">
                                            <a href="bai-viet/<?php echo $post['slug']; ?>-<?php echo $post['id'] ?>.html" title="" class="title"><?php echo $post['post_title']; ?></a>
                                            <span class="create-date"><?php echo $post['date']; ?></span>
                                            <p class="desc"><?php echo $post['post_title']; ?></p>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } else { ?>
                            <p>không có bài viết</p>
                        <?php } ?>
                    </div>
                    <div class="section" id="paging-wp">
                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                <?php if (!empty($list_post_page)) echo get_pagging_all_blog($num_page, $page_num); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>