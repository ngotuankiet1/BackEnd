<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load_view('menu');
}

function add_menuAction()
{
    global $error, $title, $url_static, $page_slug, $post_id, $product_id, $menu_order;
    if (isset($_POST['sm_add'])) {
        $error = array();
        $data = array();

        //title
        if (empty($_POST['title'])) {
            $error['title'] = "không được để trống";
        } elseif (is_exist("tbl_menu", "title", $_POST['title'])) {
            $error['title'] = "Giá trị đã tồn tại";
        } else {
            $title = $_POST['title'];
            $data['title'] = $_POST['title'];
        }

        //url_static
        if (empty($_POST['url_static'])) {
            $error['url_static'] = "không được để trống";
        } else {
            $url_static = $_POST['url_static'];
            $data['url_static'] = $_POST['url_static'];
        }

        //page_slug
        if (!empty($_POST['page_slug'])) {
            $data['page_slug'] = $_POST['page_slug'];
        }

        //product
        if (!empty($_POST['product_id'])) {
            $data['product_id'] = $_POST['product_id'];
        }

        //post
        if (!empty($_POST['post_id'])) {
            $data['post_id'] = $_POST['post_id'];
        }

        //menu_order
        if (empty($_POST['menu_order'])) {
            $error['menu_order'] = "không được để trống";
        } else {
            $menu_order = $_POST['menu_order'];
            $data['menu_order'] = $_POST['menu_order'];
        }

        if (empty($error)) {
            if (isset($data)) {
                add_menu($data);
                $error['success'] = "Thêm thành công";
            } else {
                $error['success'] = "Thêm không thành công";
            }
        }
    }
    load_view('menu');
}

function apply_menuAction()
{
    global $error;
    if (isset($_POST['sm_block_status'])) {
        $error = array();
        if (!empty($_POST['checkItem'])) {
            $check = $_POST['checkItem'];
        }
        if ($_POST['post_status'] == "delete") {
            if (!empty($_POST['checkItem'])) {
                foreach ($check as $id) {
                    db_delete("tbl_menu", "`menu_id` = '{$id}'");
                }
            } else {
                $error['select'] = "Ban  chưa chọn menu";
            }
        } else {
            $error['select'] = "Vui lòng chọn tác vụ";
        }
    }
    load_view('menu');
}

function deleteAction(){
    $id = $_GET["id"];
    db_delete("tbl_menu", "`menu_id` = '{$id}'");
    redirect("?mod=menu");
}

function editAction(){
    $id = $_GET['id'];
    global $error, $title, $url_static, $page_slug, $post_id, $product_id, $menu_order;
    if (isset($_POST['sm_add'])) {
        $error = array();
        $data = array();

        //title
        if (empty($_POST['title'])) {
            $error['title'] = "không được để trống";
        } elseif (is_exist("tbl_menu", "title", $_POST['title'])) {
            $error['title'] = "Giá trị đã tồn tại";
        } else {
            $title = $_POST['title'];
            $data['title'] = $_POST['title'];
        }

        //url_static
        if (empty($_POST['url_static'])) {
            $error['url_static'] = "không được để trống";
        } else {
            $url_static = $_POST['url_static'];
            $data['url_static'] = create_slug($_POST['url_static']);
        }

        //page_slug
        if (!empty($_POST['page_slug'])) {
            $data['page_slug'] = $_POST['page_slug'];
        }

        //product
        if (!empty($_POST['product_id'])) {
            $data['product_id'] = $_POST['product_id'];
        }

        //post
        if (!empty($_POST['post_id'])) {
            $data['post_id'] = $_POST['post_id'];
        }

        //menu_order
        if (empty($_POST['menu_order'])) {
            $error['menu_order'] = "không được để trống";
        } else {
            $menu_order = $_POST['menu_order'];
            $data['menu_order'] = $_POST['menu_order'];
        }

        if (empty($error)) {
            if (isset($data)) {
                update_menu($data,$id);
                $error['success'] = "update thành công";
            } else {
                $error['success'] = "update không thành công";
            }
        }
    }
    load_view("update_menu");
}
