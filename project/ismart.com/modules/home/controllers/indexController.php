<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load_view('index');
}

function buy_nowAction()
{
    load_view("buy_now");
}

function orderAction()
{
    global $fullname, $email, $error, $phone, $address, $note, $payment;
    $product_id = $_GET['product_id'];
    $product = db_fetch_row("select * from `tbl_product` where `product_id` = '{$product_id}'");
    if (isset($_POST['btn_order'])) {
        $error = array();
        if (!empty($_POST['fullname'])) {
            $fullname = $_POST['fullname'];
        } else {
            $error['info'] = "bạn cần nhập đầy đủ thông tin";
        }

        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
        } else {
            $error['info'] = "bạn cần nhập đầy đủ thông tin";
        }


        if (!empty($_POST['phone'])) {
            $phone = $_POST['phone'];
        } elseif (is_phone($_POST['phone'])) {
            $error['phone'] = 'Bạn cần nhập Số điện thoại đúng định dạng';
        } else {
            $error['info'] = "bạn cần nhập đầy đủ thông tin";
        }


        if (!empty($_POST['note'])) {
            $note = $_POST['note'];
        } else {
            $error['info'] = "bạn cần nhập đầy đủ thông tin";
        }

        if (!empty($_POST['province'])) {
            $province = $_POST['province'];
        } else {
            $error['info'] = "bạn cần nhập đầy đủ thông tin";
        }

        if (!empty($_POST['district'])) {
            $district = $_POST['district'];
        } else {
            $error['info'] = "bạn cần nhập đầy đủ thông tin";
        }

        if (!empty($_POST['commune'])) {
            $commune = $_POST['commune'];
        } else {
            $error['info'] = "bạn cần nhập đầy đủ thông tin";
        }

        if (!empty($_POST['payment_method'])) {
            $payment = $_POST['payment_method'];
        } else {
            $error['payment_method'] = "Vui lòng chọn hình thức thanh toán";
        }

        if (empty($error)) {
            $address = $province . ', ' . $district . ', ' . $commune;
            $data = array(
                'order_code' => 'DT' . time(),
                'fullname' => $fullname,
                'email' => $email,
                'num_phone' => $phone,
                'address' => $address,
                'note' => $note,
                'num_order' => 1,
                'total_price' => $product['price_new'],
                'order_status' => 'Chờ duyệt',
                'payment' => $payment,
                'create_date' => date('d/m/Y H:i:s'),
            );
            insert_order($data);
            $data_customer = array(
                'fullname' => $fullname,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'create_date' => date('d/m/Y H:i:s'),
            );
            $data_order_update = array(
                'fullname' => $fullname,
                'email' => $email,
                'num_phone' => $phone,
                'address' => $address,
            );
            $num_customer = get_num_customer($phone);
            if ($num_customer > 0) {
                update_customer($data_customer, $phone);
                update_order_by_phone($data_order_update, $phone);
            } else {
                insert_customer($data_customer);
            }

            $data_products_order = array(
                'order_code' => 'DT' . time(),
                'product_qty' => 1,
                'sud_total' => $product['price_new'],
                'product_id' => $product_id,
            );
            insert_product_order($data_products_order);
            $error['success'] = "Đặt hàng thành công";
            unset($_SESSION['cart']);
        }
    }
    load_view('buy_now');
}

function search_productAction()
{
    global $value;
    if (isset($_POST['sm-s'])) {
        if (!empty($_POST['value'])) {
            $value = $_POST['value'];
            load_view("search_product", $value);
        } else {
            load_view("index");
        }
    } else {
        load_view("index");
    }
}

function pagination_searchAction()
{
    $result_search = '';

    if (isset($_POST['cat_id'])) {
        $cat_id = $_POST['cat_id'];
        $cat = db_fetch_assoc("SELECT `title` FROM `tbl_product_cat` WHERE `cat_id` = '{$cat_id}'");
    }

    if (isset($_POST['value'])) {
        $value = $_POST['value'];
    }
    // $query = "SELECT * FROM `tbl_product` WHERE `parent_cat` = '{$cat['title']}' AND (CONVERT(`product_name` USING utf8) LIKE '%$value %' OR  CONVERT(`product_code` USING utf8) LIKE '%$value %') ";
    $query = "SELECT * FROM `tbl_product` WHERE `parent_cat` = '{$cat['title']}' AND (CONVERT(`product_name` USING utf8) LIKE '%$value %' OR CONVERT(`product_code` USING utf8) LIKE '%$value %') ";

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
    $num_per_page = 4;
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

    $result_search .= '
    <div class="section-detail">
        <ul class="list-item clearfix">';

    if (!empty($list_product_by_cat)) {
        foreach ($list_product_by_page as $product) {
            $result_search .= '
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
        $result_search .= '<p>không có sản phẩm!</p>';
    }

    $result_search .= '</ul>
    </div>';

    $result_search .= '
    <div class="section" id="paging-wp">
        <div class="section-detail">
            <ul class="list-item clearfix">
            ' . get_pagging_search_all($num_page, $page_num, $value, $cat_id) . ';
            </ul>
        </div>
    </div>';

    $data = array(
        'result_search' => $result_search,
    );

    echo json_encode($data);
}

function search_filterAction()
{
    load_view("search_product");
}
