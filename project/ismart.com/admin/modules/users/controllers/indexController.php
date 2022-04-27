<?php
function construct()
{
    load_model('index');
    load("helper", "images");
}

function info_adminAction()
{
    global $error, $display_name, $email, $tel, $address;
    $username = $_SESSION['users_login'];
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
                $old_thumb = info_user('avatar');
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
            $avatar = info_user('avatar');
            $data['avatar'] = $avatar;
        }


        if (empty($error)) {
            if (!empty($data)) {
                $user = $_SESSION['users_login'];
                update_info_admin($data, $user);
                $error['success'] = "Cập nhật thành công";
            } else {
                $error['success'] = "Cập nhật không thành công";
            }
        }
    }
    load_view('info_admin');
}

function change_passAction()
{
    global $error, $pass_old;
    $success = array();
    if (isset($_POST['btn-chanle'])) {
        $error = array();
        if (empty($_POST['pass-old'])) {
            $error['pass-old'] = 'Không được để trống password';
        } else {
            if (!is_password($_POST['pass-old'])) {
                $error['pass-old'] = 'password không đúng định dang';
            } elseif (!check_pass($_POST['pass-old'])) {
                $error['pass-old'] = 'Mật khẩu không chính xác';
            } else {
                $pass_old = $_POST['pass-old'];
            }
        }

        if (empty($_POST['pass-new'])) {
            $error['pass-new'] = 'Không được để trống password';
        } else {
            if (!is_password($_POST['pass-new'])) {
                $error['pass-new'] = 'password không đúng định dang';
            } else {
                $pass_new = $_POST['pass-new'];
            }
        }

        if (empty($_POST['confirm-pass'])) {
            $error['confirm-pass'] = 'Không được để trống password';
        } else {
            if (!is_password($_POST['confirm-pass'])) {
                $error['confirm-pass'] = 'password không đúng định dang';
            } elseif ($pass_new != $_POST['confirm-pass']) {
                $error['confirm-pass'] = 'Mật khẩu không trùng khớp';
            } else {
                $confirm_pass = $_POST['confirm-pass'];
            }
        }
    }
    if (empty($error)) {
        $data = array(
            'password' => @$pass_new,
        );
        update_pass($data, @$pass_old);
        $success['success'] = "Thay đổi mật khẩu thành công";
    }

    load_view('change_pass', $success);
}

function loginAction()
{
    global $error;
    if (isset($_POST["btn-login"])) {
        $error = array();
        if (empty($_POST['username'])) {
            $error['username'] = 'Không được để trống username';
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = 'username không đúng định dang';
            } else {
                $username = $_POST['username'];
            }
        }
        if (empty($_POST['password'])) {
            $error['password'] = 'Không được để trống password';
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = 'password không đúng định dang';
            } else {
                $password = $_POST['password'];
            }
        }

        if (empty($error)) {
            if (check_login($username, $password)) {
                $_SESSION['is_login'] = true;
                $_SESSION['users_login'] = $username;
                update_active_admin();
                redirect("?mod=users&controller=team&action=index");
            } else {
                $error['login'] = "Tài khoản hoặc MK không chính xác";
            }
        }
    }
    load_view('login');
}

function logoutAction()
{
    update_not_active_admin();
    load_view('logout');
}


function resetpassAction()
{
    global $error, $password, $email;
    $token = @$_GET['reset_token'];
    if (!empty($token)) {
        if (check_reset_token($token)) {
            if (isset($_POST['btn_changle'])) {
                $error = array();
                if (empty($_POST['password'])) {
                    $error['password'] = 'Không được để trống password';
                } else {
                    if (!is_password($_POST['password'])) {
                        $error['password'] = 'password không đúng định dang';
                    } else {
                        $password = $_POST['password'];
                    }
                }

                if (empty($error)) {
                    $data = array(
                        'password' => $password,
                    );
                    update_password($data, $token);
                    redirect("?mod=users&action=resetOK");
                }
            } else {
                $error['btn_changle'] = "Yêu cầu lấy lại mật khẩu không hợp lệ";
            }
        }
        load_view('reset_password');
    } else {
        if (isset($_POST['btn_reset'])) {
            $error = array();
            if (empty($_POST['email'])) {
                $error['email'] = 'Không được để trống email';
            } else {
                if (!is_email($_POST['email'])) {
                    $error['email'] = 'email không đúng định dang';
                } else {
                    $email = $_POST['email'];
                }
            }

            if (empty($error)) {
                if (check_email($email)) {
                    $reset_token = md5("{$email}" . time());
                    $data = array(
                        'reset_token' => $reset_token,
                    );
                    check_reset_email($data, $email);

                    //sent mail
                    $link_reset = base_url("?mod=users&action=resetpass&reset_token={$reset_token}");
                    $content = "<p>Vui lòng click vào link sau để thực hiện việc đặt lại mật khẩu: {$link_reset} </p>";
                    sent_mail($email, '', "ĐẶT LẠI MẬT KHẨU", $content);
                } else {
                    $error['reset_email'] = "email không tồn tại trong hệ thống";
                }
            }
        }
        load_view("reset_pass");
    }
}

function resetOKAction()
{
    load_view('resetOK');
}
