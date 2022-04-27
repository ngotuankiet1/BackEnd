<?php

function construct()
{
    load_model('index');
    load("helper", "images");
}

function indexAction(){
    load_view("list_slider");
}

function add_sliderAction()
{
    global $error, $title, $slug, $images, $desc, $num_order, $file;
    if (isset($_POST['btn-submit'])) {
        $error = array();

        //slider name
        if (empty($_POST['title'])) {
            $error['title'] = "Không để trống";
        } else {
            $title = $_POST['title'];
        }

        //slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "không được để trống";
        } else {
            $slug = create_slug($_POST['slug']);
        }

        //desc
        if (empty($_POST['desc'])) {
            $error['desc'] = "không được để trống";
        } else {
            $desc = $_POST['desc'];
        }

        //num_order
        if (empty($_POST['num_order'])) {
            $error['num_order'] = "không được để trống";
        } else {
            $num_order = $_POST['num_order'];
        }

        // check upload file
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_images($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            }
        } else {
            $error['upload_image'] = "Bạn chưa upload tệp";
        }

        //status
        if (empty($_POST['status'])) {
            $error['status'] = "không được để trống";
        } else {
            $status = $_POST['status'];
        }

        if (empty($error)) {
            $creator = get_admin_info($_SESSION['users_login']);
            $images = upload_image("public/images/files/slider/", $type);
            $data = array(
                'slider_name' => $title,
                'slider_link' => $slug,
                'slider_desc' => $desc,
                'num_order' => $num_order,
                'images_slider' => $images,
                'creator' => $creator,
                'status' => $status,
                'date' => date("d/m/Y"),
            );
            add_slider($data);
            $error['slider'] = "Thêm slider mới thành công" . "<br>" . "<a href='?mod=slider&action=index'>Trở về danh sách slider</a>";
        }
    }
    load_view("add_slider");
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
                            'status' => 'Approved',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_slider($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_slider');
                        } else {
                            load_view('list_slider');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_slider');
                        } else {
                            load_view('list_slider');
                        }
                    }
                }
                //Chờ phê duyệt
                if ($_POST['actions'] == 2) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'status' => 'Waitting...',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_slider($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_slider');
                        } else {
                            load_view('list_slider');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_slider');
                        } else {
                            load_view('list_slider');
                        }
                    }
                }

                //bỏ vào thùng rác
                if ($_POST['actions'] == 3) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'status' => 'Trash',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_slider($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_slider');
                        } else {
                            load_view('list_slider');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_slider');
                        } else {
                            load_view('list_slider');
                        }
                    }
                }
            }else {
                $error['select'] = 'Bạn chưa lựa chọn tác vụ';
                if (isset($_GET['value'])) {
                    load_view('search_slider');
                } else {
                    load_view('list_slider');
                }
            }
        } else {
            $error['select'] = "Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('search_slider');
            } else {
                load_view('list_slider');
            }
        }
    }
}

function delete_sliderAction()
{
    $id = $_GET['slider_id'];
    db_delete("tbl_slider", "`slider_id` = $id");
    redirect("?mod=slider");    
}

function update_sliderAction()
{
    $slider_id = $_GET['slider_id'];
    global $error,$data, $title, $slug, $images, $desc, $num_order, $file;
    if (isset($_POST['btn-submit'])) {
        $error = array();
        $data = array();
        
        //slider name
        if (empty($_POST['title'])) {
            $error['title'] = "Không để trống";
        } else {
            $data['slider_name'] = $_POST['title'];
        }

        //slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "không được để trống";
        } else {
            $data['slider_link'] = create_slug($_POST['slug']);
        }

        //desc
        if (empty($_POST['desc'])) {
            $error['desc'] = "không được để trống";
        } else {
            $data['slider_desc'] = $_POST['desc'];
        }

        //num_order
        if (empty($_POST['num_order'])) {
            $error['num_order'] = "không được để trống";
        } else {
            $data['num_order'] = $_POST['num_order'];
        }

         // check upload file
         if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_images($type, $size)) {
                $error['upload_image'] = "Kích thước hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = info_slider('images_slider', $slider_id);
                if (!empty($old_thumb)) {
                    delete_image($old_thumb);
                    $avatar = upload_image('public/images/files/slider/', $type);
                    $data['images_slider'] = $avatar;
                } else {
                    $avatar = upload_image('public/images/files/slider/', $type);
                    $data['images_slider'] = $avatar;
                }
            }
        } else {
            $avatar = info_slider('images_slider', $slider_id);
            $data['images_slider'] = $avatar;
        }

        //status
        if (empty($_POST['status'])) {
            $error['status'] = "không được để trống";
        } else {
            $status = $_POST['status'];
        }


        if (empty($error)) {
            $creator = get_admin_info($_SESSION['users_login']);
            $data['editor'] = $creator;
            $data['edit_date'] = date("d/m/Y");
            if (!empty($data)) {
                update_slider($data, $slider_id);
                $error['success'] = "Cập nhật thành công";
            } else {
                $error['success'] = "Cập nhật không thành công";
            }
        }
    }
    load_view('update_slider');
}

//search
function search_pageAction()
{
    global $error, $value;
    $error = array();
    if (isset($_GET['sm_s'])) {
        if (!empty($_GET['value'])) {
            load_view('search_slider');
        } else {
            $error['search'] = "Vui lòng nhập giá trị tìm kiếm!";
            load_view('list_slider');
        }
    }
}

function result_searchAction()
{
    global $value;
    if (!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('search_slider');
}


