<?php

function construct()
{
    load_model('index');
}

function customerAction()
{
    load_view('list_customer');
}


function apply_customerAction()
{
    global $error;
    if (isset($_POST['sm_action'])) {
        $error = array();
        if (is_login() && check_role($_SESSION['users_login']) == 1) {
            if (isset($_POST['checkItem'])) {
                $list_customer_id = $_POST['checkItem'];
            }
            //Phê duyệt
            if (!empty($_POST['actions'])) {
                if ($_POST['actions'] == 1) {
                    if (isset($_POST['checkItem'])) {
                        foreach ($list_customer_id as $customer_id) {
                            db_delete('tbl_customers', "`customer_id` = '$customer_id'");
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_customer');
                        } else {
                            load_view('list_customer');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_customer');
                        } else {
                            load_view('list_customer');
                        }
                    }
                }
            } else {
                $error['select'] = 'Bạn chưa lựa chọn tác vụ';
                if (isset($_GET['value'])) {
                    load_view('search_customer');
                } else {
                    load_view('list_customer');
                }
            }
        } else {
            $error['select'] = "Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('search_customer');
            } else {
                load_view('list_customer');
            }
        }
    }
}

function deleteAction()
{
    $customer_id = $_GET['customer_id'];
    db_delete('tbl_customers', "`customer_id` = '$customer_id'");
    redirect("?mod=order&controller=customer&action=customer");
}

function searchAction()
{
    global $error, $value;
    $error = array();
    if (isset($_GET['sm_s'])) {
        if (!empty($_GET['value'])) {
            $value = $_GET['value'];
            load_view('search_customer');
        } else {
            $error['search'] = "Bạn chưa nhập thông tin tìm kiếm";
            load_view('list_customer');
        }
    }
}

function result_searchAction()
{
    load_view('search_customer');
}
