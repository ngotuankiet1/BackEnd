<?php

function construct()
{
    load_model('index');
    load("helper", "images");
}

function indexAction()
{
    if (isset($_GET['value'])) {
        load_view('search_admin');
    } else {
        load_view("teamindex");
    }
}

//THÊM ADMIN
function addAction()
{
    global $fullname, $username, $password, $email, $error, $tel, $role, $address;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    if (isset($_POST["btn-add-admin"])) {
        $error = array();
        //fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = 'Không được để trống fullname';
        } else {
            $fullname = $_POST['fullname'];
        }
        //email
        if (empty($_POST['email'])) {
            $error['email'] = 'Không được để trống email';
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = 'email không đúng định dang';
            } else {
                $email = $_POST['email'];
            }
        }
        //username
        if (empty($_POST['username'])) {
            $error['username'] = 'Không được để trống username';
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = 'username không đúng định dang';
            } elseif (check_username($_POST['username'])) {
                $error['username'] = "username đã tồn tại trong hệt thống";
            } else {
                $username = $_POST['username'];
            }
        }
        //tel
        if (empty($_POST['tel'])) {
            $error['tel'] = 'Không được để trống Số điện thoại';
        } else {
            $tel = $_POST['tel'];
        }
        //address
        if (empty($_POST['address'])) {
            $error['address'] = 'Không được để trống Địa chỉ';
        } else {
            $address = $_POST['address'];
        }
        //password
        if (empty($_POST['password'])) {
            $error['password'] = 'Không được để trống password';
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = 'password không đúng định dang';
            } else {
                $password = $_POST['password'];
            }
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

        //role(phân quyền)
        if (empty($_POST['role'])) {
            $error['role'] = "không để trống phân quyền";
        } else {
            $role = $_POST['role'];
        }

        if (empty($error)) {
            if (is_login() && check_role($_SESSION['users_login']) == 1) {
                $admin_status = 'Approved';
            } else {
                $admin_status = 'Waitting...';
            }
            $avatar = upload_image("public/images/files/users/", $type);
            $creator = get_admin_info($_SESSION['users_login']);
            $data = array(
                'avatar' => $avatar,
                'username' => $username,
                'password' => $password,
                'fullname' => $fullname,
                'email' => $email,
                'phone_number' => $tel,
                'address' => $address,
                'reg_date' => date("d/m/Y"),
                'creator' => $creator,
                'role' => $role,
                'active' => "không hoạt động",
                'admin_status' => $admin_status,
            );
            add_admin($data);
            $error['admin'] = "Thêm ADMIN mới thành công" . "<br>" . "<a href='?mod=users&controller=team&action=index'>Trở về danh sách ADMIN</a>";
        }
    }
    load_view("add_admins");
}

// CẬP NHẬT ADMIN
function update_adminAction()
{
    global $error, $display_name, $email, $tel, $address;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    if (isset($_POST['btn-submit'])) {
        $error = array();
        $data = array();
        //fullname
        if (empty($_POST['display-name'])) {
            $error['display-name'] = 'Không được để trống Tên hiển thị';
        } else {
            $data['fullname'] = $_POST['display-name'];
        }

        //email
        if (empty($_POST['email'])) {
            $error['email'] = 'Không được để trống Email';
        } else {
            $data['email'] = $_POST['email'];
        }

        //tel
        $data['phone_number'] = $_POST['tel'];
        //address
        $data['address'] = $_POST['address'];


        // check upload file
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_images($type, $size)) {
                $error['upload_image'] = "Kích thước hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = info_admin('avatar', $id);
                if (!empty($old_thumb)) {
                    delete_image($old_thumb);
                    $avatar = upload_image('public/images/files/users/', $type);
                    $data['avatar'] = $avatar;
                } else {
                    $avatar = upload_image('public/images/files/users/', $type);
                    $data['avatar'] = $avatar;
                }
            }
        } else {
            $avatar = info_admin('avatar', $id);
            $data['avatar'] = $avatar;
        }


        if (empty($error)) {
            if (!empty($data)) {
                update_admin($data, $id);
                $error['success'] = "Cập nhật thành công";
            } else {
                $error['success'] = "Cập nhật không thành công";
            }
        }
    }
    load_view('update_admin');
}

//TÁC VỤ ADMIN
function apply_adminsAction()
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
                            'admin_status' => 'Approved',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_admin($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_admin');
                        } else {
                            load_view('teamindex');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_admin');
                        } else {
                            load_view('teamindex');
                        }
                    }
                }
                //Chờ phê duyệt
                if ($_POST['actions'] == 2) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'admin_status' => 'Waitting...',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_admin($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_admin');
                        } else {
                            load_view('teamindex');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_admin');
                        } else {
                            load_view('teamindex');
                        }
                    }
                }

                //bỏ vào thùng rác
                if ($_POST['actions'] == 3) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'admin_status' => 'Trash',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_admin($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_admin');
                        } else {
                            load_view('teamindex');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_admin');
                        } else {
                            load_view('teamindex');
                        }
                    }
                }
            }else {
                $error['select'] = 'Bạn chưa lựa chọn tác vụ';
                if (isset($_GET['value'])) {
                    load_view('search_admin');
                } else {
                    load_view('teamIndex');
                }
            }
        } else {
            $error['select'] = "Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('search_admin');
            } else {
                load_view('teamindex');
            }
        }
    }
}

function deleteAction()
{
    $id = $_GET['id'];
    delete_admin($id);
    redirect("?mod=users&controller=team&action=index");
}


function search_adminAction()
{
    global $error, $value;
    $error = array();
    if (isset($_GET['sm_s'])) {
        if (!empty($_GET['value'])) {
            $value = $_GET['value'];
            #Số bản ghi/trang
            $num_per_page = 3;

            #Tổng số bản ghi
            $list_admins_all = db_search_all_admins($value);
            $total_row = count($list_admins_all);

            #Số trang
            $num_page = ceil($total_row / $num_per_page);
            load_view('search_admin');
        } else {
            $error['search'] = "Vui lòng nhập giá trị tìm kiếm!";
            load_view('teamindex');
        }
    }
}

function result_searchAction()
{
    global $value;
    if (!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('search_admin');
}
