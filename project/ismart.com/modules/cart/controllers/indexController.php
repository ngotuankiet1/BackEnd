<?php

function construct()
{
    load_model('index');
}


function indexAction()
{
    load_view('index');
}

function checkoutAction()
{
    if (get_number_order_cart() >= 1) {
        load_view('checkout');
    } else {
        load_view('index');
    }
}

function add_cartAction()
{
    $product_id = $_GET['product_id'];
    add_cart($product_id);
    redirect_to('gio-hang.html');
}


function delete_cartAction()
{
    $product_id = $_GET['product_id'];
    delete_cart($product_id);
    redirect_to('gio-hang.html');
}

function update_cartAction()
{
    if (isset($_POST['update_cart'])) {
        update_cart($_POST['num-order']);
        redirect_to('gio-hang.html');
    }
}

function ajax_cartAction()
{
    $id = $_POST['id'];
    $qty = $_POST['qty'];

    $item = db_fetch_row("select * from `tbl_product` where `product_id` = '{$id}'");

    if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        $_SESSION['cart']['buy'][$id]['qty'] = $qty;
        $sud_total = $item['price_new'] * $qty;
        $_SESSION['cart']['buy'][$id]['sud_total'] = $sud_total;

        update_info_cart();

        $num_order = get_number_order_cart();
        $total = get_total_cart();

        $data = array(
            'num_order' => $num_order,
            'total' => currency_format($total),
            'sud_total' => currency_format($sud_total),
        );

        echo json_encode($data);
    }
}

function select_districtAction()
{
    $select_district = '<option value="">-Chọn Quận/Huyện-</option>';
    if (!empty($_POST['province'])) {
        $province = $_POST['province'];
        $matp = get_matp_by_province($province);
        $list_district = db_fetch_array("select * from `tbl_district` where `matp` = '{$matp}'");
        foreach ($list_district as $district) {
            $select_district .= '<option value="' . $district['name'] . '"> ' . $district['name'] . ' </option>';
        }
    }
    echo $select_district;
}

function select_communeAction()
{
    $select_commune = '<option value="">-Chọn Xã/Phường-</option>';
    if (!empty($_POST['district'])) {
        $district = $_POST['district'];
        $maqh = get_matp_by_district($district);
        $list_commune = db_fetch_array("select * from `tbl_commune` where `maqh` = '{$maqh}'");
        foreach ($list_commune as $commune) {
            $select_commune .= '<option value="' . $commune['name'] . '"> ' . $commune['name'] . ' </option>';
        }
    }
    echo $select_commune;
}

function orderAction()
{
    global $fullname, $email, $error, $phone, $address, $note, $payment;
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
                'num_order' => get_number_order_cart(),
                'total_price' => get_total_cart(),
                'order_status' => 'Waitting...',
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

            $list_buy = get_product_cart();
            foreach ($list_buy as $product) {
                $data_products_order = array(
                    'order_code' => 'DT' . time(),
                    'product_qty' => $product['qty'],
                    'sud_total' => $product['sud_total'],
                    'product_id' => $product['product_id'],
                );
                insert_product_order($data_products_order);
            };
            $error['success'] = "Đặt hàng thành công";
            unset($_SESSION['cart']);
        }
    }
    load_view('checkout');
}
