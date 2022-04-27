<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load_view("list_cat_product");
}

//ADD   
function add_cat_productAction()
{
    global $error, $title, $slug;
    if (isset($_POST['btn-submit'])) {
        $error = array();

        //title
        if (empty($_POST['title'])) {
            $error['title'] = "không được để trống title";
        } elseif (is_exist("tbl_product_cat", "title", $_POST['title'])) {
            $error['title'] = "danh mục đã tồn tại trong hệ thống";
        } else {
            $title = $_POST["title"];
        }

        //slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "không được để trống slug";
        } elseif (is_exist("tbl_product_cat", "slug", $_POST['slug'])) {
            $error['slug'] = "danh mục đã tồn tại trong hệ thống";
        } else {
            $slug = create_slug($_POST['slug']);
        }

        if (empty($_POST['parent_cat'])) {
            $cat_parent = 0;
        } else {
            $cat_parent = $_POST['parent_cat'];
        }

        if (empty($error)) {
            if (is_login() && check_role($_SESSION['users_login']) == 1) {
                $cat_status = 'Approved';
            } else {
                $cat_status = 'Waitting...';
            }
            $creator = get_admin_info($_SESSION['users_login']);
            $data = array(
                'title' => $title,
                'slug' => $slug,
                'cat_parent' => $cat_parent,
                'creator' => $creator,
                'date' => date("d/m/Y"),
                'cat_status' => $cat_status,
            );
            add_cat_product($data);
            $error['product'] = "Thêm danh mục mới thành công" . "<br>" . "<a href='?mod=product&controller=cat_product&action=index'>Trở về danh sách danh mục</a>";
        }
    }
    load_view("add_cat_product");
}


function apply_pageAction()
{
    global $error;
    if (isset($_POST['sm_action'])) {
        $error = array();
        if (is_login() && check_role($_SESSION['users_login']) == 1) {
            if (isset($_POST['checkItem'])) {
                $list_admin_id = $_POST['checkItem'];
            }
            //Phê duyệt
            if (!empty($_POST['actions'])) {
                if ($_POST['actions'] == 1) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'cat_status' => 'Approved',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_cat_product($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_cat_product');
                        } else {
                            load_view('list_cat_product');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_cat_product');
                        } else {
                            load_view('list_cat_product');
                        }
                    }
                }
                //Chờ phê duyệt
                if ($_POST['actions'] == 2) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'cat_status' => 'Waitting...',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_cat_product($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_cat_product');
                        } else {
                            load_view('list_cat_product');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_cat_product');
                        } else {
                            load_view('list_cat_product');
                        }
                    }
                }

                //bỏ vào thùng rác
                if ($_POST['actions'] == 3) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'cat_status' => 'Trash',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_cat_product($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_cat_product');
                        } else {
                            load_view('list_cat_product');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_cat_product');
                        } else {
                            load_view('list_cat_product');
                        }
                    }
                }
            }else {
                $error['select'] = 'Bạn chưa lựa chọn tác vụ';
                if (isset($_GET['value'])) {
                    load_view('search_cat_product');
                } else {
                    load_view('list_cat_product');
                }
            }
        } else {
            $error['select'] = "Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('search_cat_product');
            } else {
                load_view('list_cat_product');
            }
        }
    }
}

function delete_catAction()
{
    $cat_id = $_GET['id_cat_product'];
    db_delete("tbl_product_cat", "`cat_id` = $cat_id");
    redirect("?mod=product&controller=cat_product&action=index");
}

function update_catAction()
{
    $id_cat = $_GET['id_cat_product'];
    global $error, $title, $slug;
    if (isset($_POST['btn-submit'])) {
        $error = array();
        $data = array();
        //title
        if (empty($_POST['title'])) {
            $error['title'] = "không được để trống title";
        } else {
            $data['title'] = $_POST["title"];
        }

        //slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "không được để trống slug";
        } else {
            $data['slug'] = $_POST["slug"];
        }

        if (empty($_POST['parent_cat'])) {
            $data['cat_parent'] = 0;
        } else {
            $data['cat_parent'] = $_POST['parent_cat'];
        }

        if (empty($error)) {
            $creator = get_admin_info($_SESSION['users_login']);
            $data['editor'] = $creator;
            $data['edit_date'] = date("d/m/Y");
            if (!empty($data)) {
                update_cat_product($data, $id_cat);
                $error['success'] = "Cập nhật thành công";
            } else {
                $error['success'] = "Cập nhật không thành công";
            }
        }
    }
    load_view('update_cat_product');
}

//search cat post
function search_pageAction()
{
    global $error, $value;
    $error = array();
    if (isset($_GET['sm_s'])) {
        if (!empty($_GET['value'])) {
            load_view('search_cat_product');
        } else {
            $error['search'] = "Vui lòng nhập giá trị tìm kiếm!";
            load_view('list_cat_product');
        }
    }
}

function result_searchAction()
{
    global $value;
    if (!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('search_cat_product');
}


// ==============select==================
function select_brandAction()
{
    $select_brand = '<option value="">Chọn danh mục</option>' .
        '<option value="No brand">No brand</option>';

    if (!empty($_POST['parent_cat'])) {
        $cat_title = $_POST['parent_cat'];
        $list_brand = array();
        $data = db_fetch_array("SELECT * FROM `tbl_product_cat`");
        $list_cat_product = data_tree($data, 0);
        foreach ($list_cat_product as $item) {
            if ($cat_title == $item['title']) {
                $cat_id = $item['cat_id'];
                foreach ($list_cat_product as $cat_child) {
                    if ($cat_child['cat_parent'] == $cat_id) {
                        $list_brand[] = $cat_child['title'];
                    }
                }
            }
        }
    }

    foreach ($list_brand as $brand) {
        $select_brand .= "<option value='$brand'>$brand</option>";
    }

    echo $select_brand;
}
