<?php

function construct()
{
    load_model('index');
}


function indexAction()
{
    load_view('index');
}

function cat_productAction()
{
    load_view("category_product");
}

function detail_productAction()
{
    load_view('detail_product');
}

function productAction()
{
    $output = '';
    if (isset($_POST['cat_id'])) {
        $cat_id = $_POST['cat_id'];
        $cat = db_fetch_assoc("SELECT `title` FROM `tbl_product_cat` WHERE `cat_id` = '{$cat_id}'");
    }

    $query = "SELECT * FROM  `tbl_product` WHERE `status` = 'Approved' AND  (`select_brand` = '{$cat['title']}' OR `parent_cat` = '{$cat['title']}') ";

    //filter by arrange
    if (isset($_POST['arrange'])) {
        $arrange = $_POST['arrange'];
        if ($arrange == 1) {
            $query .= "ORDER BY `product_name` DESC ";
        }
        if ($arrange == 2) {
            $query .= "ORDER BY `product_name` ASC ";
        }
        if ($arrange == 3) {
            $query .= "ORDER BY `price_new` DESC ";
        }
        if ($arrange == 4) {
            $query .=  "ORDER BY `price_new` ASC ";
        }
    }

    $list_product_by_cat = db_fetch_array($query);
    #Pagination
    #tổng số bản ghi/trang
    $num_per_page = 8;
    # tổng số bản ghi
    $total_row = count($list_product_by_cat);
    #số trang
    $num_page = ceil($total_row / $num_per_page);

    if (isset($_POST['page_num']) && !empty($_POST['page_num'])) {
        $page_num = (int) $_POST['page_num'];
        if ($_POST['page_num'] == '<<') {
            if ($page_num < 1) {
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
    $list_product_by_page = array_slice($list_product_by_cat, $start, $num_per_page);

    $output .= '
    <div class="section-detail">
        <ul class="list-item clearfix">';

    if (!empty($list_product_by_cat)) {
        foreach ($list_product_by_page as $product) {
            $output .= '
                <li>
                <a href="chi-tiet/' . $product['slug'] . '-' . $product['product_id'] . '.html" title="" class="thumb">
                    <img src="admin/' . $product['images'] . '">
                </a>
                <a href="chi-tiet/' . $product['slug'] . '-' . $product['product_id'] . '.html" title="" class="product-name">' . $product['product_name'] . '></a>
                <div class="price">
                    <span class="new">' . currency_format($product['price_new']) . '</span>
                    <span class="old">' . currency_format($product['price_old']) . '</span>
                </div>
                <div class="action clearfix">
                    <a href="gio-hang-' . $product['product_id'] . '-c.html" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                    <a href="dat-hang-' . $product['product_id'] . '-b.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                </div>
            </li>
                ';
        }
    } else {
        $output .= '<p>không có sản phẩm!</p>';
    }

    $output .= '</ul>
    </div>';

    $output .= '
    <div class="section" id="paging-wp">
        <div class="section-detail">
            <ul class="list-item clearfix">
            ' . get_pagging_all($num_page, $page_num, $cat_id) . ';
            </ul>
        </div>
    </div>';

    $data = array(
        'output' => $output,
    );

    echo json_encode($data);
}



function pagination_catAction()
{
    $output = '';
    if (!empty($_POST['cat_id'])) {
        $cat_id = $_POST['cat_id'];
        $cat = db_fetch_assoc("SELECT `title` FROM `tbl_product_cat` WHERE `cat_id` = '{$cat_id}'");
    }

    $query = "SELECT * FROM  `tbl_product` WHERE `status` = 'Approved' AND  (`select_brand` = '{$cat['title']}' OR `parent_cat` = '{$cat['title']}') ";

    //price
    if (isset($_POST['price'])) {
        $price = implode('', $_POST['price']);
        if ($price == 1) {
            $query .= "AND `price_new` < 500000 ";
        }
        if ($price == 2) {
            $query .= "AND `price_new` >= 500000 AND `price_new` < 1000000 ";
        }
        if ($price == 3) {
            $query .= "AND `price_new` >= 1000000 AND `price_new` < 5000000 ";
        }
        if ($price == 4) {
            $query .= "AND `price_new` >= 5000000 AND `price_new` < 10000000 ";
        }
        if ($price == 5) {
            $query .= "AND `price_new` >= 10000000 ";
        }
    }
    #Chú ý quan trọng khi ajxa 2 cái brand và price là ngay chỗ AND,.. phải để khoảng trắng
    //brand
    if (isset($_POST['brand']) && !empty($_POST['brand'])) {
        $brand = implode(',', $_POST['brand']);
        $query .= "AND (`select_brand` IN('{$brand}') OR `product_type` IN('{$brand}')) ";
    }
    //filter by arrange
    if (isset($_POST['arrange'])) {
        $arrange = $_POST['arrange'];
        if ($arrange == 1) {
            $query .= "ORDER BY `product_name` DESC ";
        }
        if ($arrange == 2) {
            $query .= "ORDER BY `product_name` ASC ";
        }
        if ($arrange == 3) {
            $query .= "ORDER BY `price_new` DESC ";
        }
        if ($arrange == 4) {
            $query .=  "ORDER BY `price_new` ASC ";
        }
    }

    $list_products_by_cat = db_fetch_array($query);

    #Pagination
    #tổng số bản ghi/trang
    $num_per_page = 8;
    # tổng số bản ghi
    $total_row = count($list_products_by_cat);
    #số trang
    $num_page = ceil($total_row / $num_per_page);

    if (isset($_POST['page_num']) && !empty($_POST['page_num'])) {
        $page_num = (int) $_POST['page_num'];
        if ($_POST['page_num'] == '<<') {
            if ($page_num < 1) {
                $page_num = 1;
            } else {
                $page_num -= 1;
            }
        }

        if ($_POST['page_num'] == '>>') {
            if ($page_num = $num_page) {  //chú ý 1 dấu =
                $page_num = $num_page;
            } else {
                $page_num += 1;
            }
        }
    } else {
        $page_num = 1;
    }


    $start = ($page_num - 1) * $num_per_page;
    $list_product_by_page = array_slice($list_products_by_cat, $start, $num_per_page);
    $output .= '<div class="section-detail">
                    <ul class="list-item clearfix">';
    if (!empty($list_product_by_page)) {
        foreach ($list_product_by_page as $product) {
            $output .= '
            <li>
            <a href="?mod=product&action=detail_product&product_id= ' . $product['product_id'] . '" title="" class="thumb">
            <img src="admin/' . $product['images'] . '")
            </a>
            <a href="?mod=product&action=detail_product&product_id= ' . $product['product_id'] . '" title="" class="product-name">' . $product['product_name'] . '</a>
            <div class="price">
                <span class="new">' . currency_format($product['price_new']) . '</span>
                <span class="old">' . currency_format($product['price_old']) . '</span>
            </div>
            <div class="action clearfix">
                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
            </div>
            </li>
        ';
        }
    } else {
        $output .= '<p>không có sản phẩm</p>';
    }

    $output .= '</ul>
        </div>';

    if (!empty($list_product_by_page)) {
        $output .= '
        <div class="section" id="paging-wp">
            <div class="section-detail">
                <ul class="list-item clearfix" id="pagging-filter">
                ' . get_paggings($num_page, $page_num) . '
                </ul>
            </div>
        </div>
        ';
    }

    $data = array(
        'output' => $output,
        'num_page' => $num_page,
        'num_filter' => $total_row,
    );

    echo json_encode($data);
}
