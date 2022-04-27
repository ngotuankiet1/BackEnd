<?php

function construct()
{
    load_model('index');
}
function indexAction()
{
    load_view('index');
}

function detailAction()
{
    load_view('detail');
}

function pagination_postAction()
{
    $output = "";

    $list_post = db_fetch_array("select * from `tbl_post` where `post_status` = 'Approved'");

    $num_per_page = 2;
    $total_post = count($list_post);
    $num_page = ceil($total_post / $num_per_page);

    if (!empty($_POST['page_num'])) {
        $page_num = (int)$_POST['page_num'];
        if ($_POST['page_num'] == '<<') {
            if ($page_num <= 1) {
                $page_num = 1;
            } else {
                $page_num -= 1;
            }
        }

        if ($_POST['page_num'] == '>>') {
            if ($page_num = $num_page) {
                $page_num = $num_page;
            } else {
                $page_num += 1;
            }
        }
    } else {
        $page_num = 1;
    }

    $start = ($page_num - 1) * $num_per_page;
    $list_post_page = array_slice($list_post, $start, $num_per_page);


    $output .= '
    <div class="section-detail">
        <ul class="list-item">
    ';

    if (!empty($list_post_page)) {
        foreach ($list_post_page as $post) {
            $output .= '
            <li class="clearfix">
                <a href="bai-viet/' . $post['slug'] . '-' . $post['id'] . '.html" title="" class="thumb fl-left">
                <img src="admin/' . $post['images'] . '" alt="">
                </a>
                <div class="info fl-right">
                    <a href="bai-viet/' . $post['slug'] . '-' . $post['id'] . '.html" title="" class="title">' . $post['post_title'] . '</a>
                    <span class="create-date">' . $post['date'] . '</span>
                    <p class="desc">' . $post['post_title'] . '</p>
                </div>
            </li>';
        }
    } else {
        $output .= '<p>không có bài viết</p>';
    }

    $output .= '
        </ul>
    </div>';

    $output .= '
    <div class="section" id="paging-wp">
        <div class="section-detail">
            <ul class="list-item clearfix">
             ' . get_pagging_all_blog($num_page, $page_num) . ';
            </ul>
        </div>
    </div>';

    $data = array(
        'output' => $output,
    );

    echo json_encode($data);
}
