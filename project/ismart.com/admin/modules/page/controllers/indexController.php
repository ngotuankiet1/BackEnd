<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load_view('pageindex');
}


function add_pageAction()
{
    global $error, $title, $desc, $slug, $category;
    if (isset($_POST['btn-submit'])) {
        $error = array();

        //title
        if (empty($_POST['title'])) {
            $error['title'] = 'Không được để trống title';
        } else {
            $title = $_POST['title'];
        }

        //slug
        if (empty($_POST['slug'])) {
            $error['slug'] = 'Không được để trống slug';
        } else {
            $slug = $_POST['slug'];
        }

        //desc
        if (empty($_POST['desc'])) {
            $error['desc'] = 'Không được để trống desc';
        } else {
            $desc = $_POST['desc'];
        }

        //category
        if (empty($_POST['category'])) {
            $error['category'] = 'Không được để trống category';
        } else {
            $category = $_POST['category'];
        }

        if (empty($error)) {
            if (is_login() && check_role($_SESSION['users_login']) == 1) {
                $page_status = 'Approved';
            } else {
                $page_status = 'Waitting...';
            }
            $creator = get_admin_info($_SESSION['users_login']);
            $data = array(
                'title' => $title,
                'slug' => $slug,
                'content_page' => $desc,
                'category' => $category,
                'page_status' => $page_status,
                'cretor' => $creator,
                'date' => date("d/m/Y"),
            );
            add_page($data);
            $error['pages'] = "Thêm trang mới thành công" . "<br>" . "<a href='?mod=page&action=index'>Trở về danh sách PAGE</a>";
        }
    }
    load_view('add_page');
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
                            'page_status' => 'Approved',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_page($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_page');
                        } else {
                            load_view('pageindex');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_page');
                        } else {
                            load_view('pageindex');
                        }
                    }
                }
                //Chờ phê duyệt
                if ($_POST['actions'] == 2) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'page_status' => 'Waitting...',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_page($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_page');
                        } else {
                            load_view('pageindex');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_page');
                        } else {
                            load_view('pageindex');
                        }
                    }
                }

                //bỏ vào thùng rác
                if ($_POST['actions'] == 3) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'page_status' => 'Trash',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_page($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_page');
                        } else {
                            load_view('pageindex');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_page');
                        } else {
                            load_view('pageindex');
                        }
                    }
                }
            }else {
                $error['select'] = 'Bạn chưa lựa chọn tác vụ';
                if (isset($_GET['value'])) {
                    load_view('search_page');
                } else {
                    load_view('pageindex');
                }
            }
        } else {
            $error['select'] = "Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('search_page');
            } else {
                load_view('pageindex');
            }
        }
    }
}


function update_pageAction()
{
    global $error, $title, $desc, $slug, $file, $category;
    $id_page = $_GET['id_page'];

    if (isset($_POST['btn-submit'])) {
        $error = array();
        $data = array();

        //title
        if (empty($_POST['title'])) {
            $error['title'] = 'Không được để trống title';
        } else {
            $data['title'] = $_POST['title'];
        }

        //slug
        if (empty($_POST['slug'])) {
            $error['slug'] = 'Không được để trống slug';
        } else {
            $data['slug'] = $_POST['slug'];
        }

        //desc
        if (empty($_POST['desc'])) {
            $error['desc'] = 'Không được để trống desc';
        } else {
            $data['content_page'] = $_POST['desc'];
        }

        //category
        if (empty($_POST['category'])) {
            $error['category'] = 'Không được để trống category';
        } else {
            $data['category'] = $_POST['category'];
        }

        if (empty($error)) {
            if (!empty($data)) {
                update_page($data, $id_page);
                $error['success'] = "Cập nhật thành công";
            } else {
                $error['success'] = "Cập nhật không thành công";
            }
        }
    }
    load_view("update_page");
}

//delete 
function delete_pageAction()
{
    $id_page = $_GET['id_page'];
    delete_page($id_page);
    redirect("?mod=page");
}

//search page
function search_pageAction()
{
    global $error, $value;
    $error = array();
    if (isset($_GET['sm_s'])) {
        if (!empty($_GET['value'])) {
            load_view('search_page');
        } else {
            $error['search'] = "Vui lòng nhập giá trị tìm kiếm!";
            load_view('pageindex');
        }
    }
}

function result_searchAction()
{
    global $value;
    if (!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('search_page');
}

