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
    load_view('detail_order');
}

function apply_detailAction()
{
    global $error;
    $order_id = $_GET['order_id'];
    if (isset($_POST['sm_status'])) {
        $error = array();
        //chờ duyệt
        if ($_POST['status'] == 1) {
            $data = array(
                'order_status' => 'Chờ duyệt',
            );
            update_order($data, $order_id);
        }
        //đang vận chuyển
        if ($_POST['status'] == 2) {
            $data = array(
                'order_status' => 'Đang vận chuyển',
            );
            update_order($data, $order_id);
        }
        //thành công
        if ($_POST['status'] == 3) {
            $data = array(
                'order_status' => 'Thành công',
            );
            update_order($data, $order_id);
        }
    } else {
        $error['select'] = "Bạn vui lòng chọn tác vụ";
    }
    load_view('detail_order');
}

function apply_orderAction()
{
    global $error;
    if (isset($_POST['sm_action'])) {
        $error = array();
        if (is_login() && check_role($_SESSION['users_login']) == 1) {
            if (isset($_POST['checkItem'])) {
                $list_customer_id = $_POST['checkItem'];
            }

            if (!empty($_POST['actions'])) {
                //Phê duyệt
                if ($_POST['actions'] == 1) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'order_status' => 'Approved',
                        );
                        foreach ($list_customer_id as $customer_id) {
                            update_order($data, $customer_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_order');
                        } else {
                            load_view('index');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_order');
                        } else {
                            load_view('index');
                        }
                    }
                }
                //chờ duyệt
                if ($_POST['actions'] == 2) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'order_status' => 'Waitting...',
                        );
                        foreach ($list_customer_id as $customer_id) {
                            update_order($data, $customer_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_order');
                        } else {
                            load_view('index');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_order');
                        } else {
                            load_view('index');
                        }
                    }
                }
                //thùng rác
                if ($_POST['actions'] == 3) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'order_status' => 'Trash',
                        );
                        foreach ($list_customer_id as $customer_id) {
                            update_order($data, $customer_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_order');
                        } else {
                            load_view('index');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_order');
                        } else {
                            load_view('index');
                        }
                    }
                }
            } else {
                $error['select'] = 'Bạn chưa lựa chọn tác vụ';
                if (isset($_GET['value'])) {
                    load_view('search_order');
                } else {
                    load_view('index');
                }
            }
        } else {
            $error['select'] = "Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('search_order');
            } else {
                load_view('index');
            }
        }
    }
}

function searchAction()
{
    global $error, $value;
    if (isset($_GET['sm_s'])) {
        if (!empty($_GET['value'])) {
            $value = $_GET['value'];
            load_view("search_order");
        } else {
            $error['search'] = "Vui lòng nhập thông tin tìm kiếm";
            load_view("index");
        }
    }
}

function result_searchAcion()
{
    load_view("search_order");
}

function deleteAction()
{
    $order_id = $_GET['order_id'];
    db_delete('tbl_order', "`id_order` = '{$order_id}'");
    redirect("?mod=order");
}

function update_orderAction()
{
    load_view("update_order");
}
