<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction() {
    echo "ok";
}

function loginAction() {
    global $error, $username, $password;
    if (isset($_POST['btn_login'])) {
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
            if (check_logins($username, $password)) {
                if (isset($_POST['remember'])) {
                    setcookie("login", base64_encode(true), time() + 3000);
                    setcookie("users_login", $username, time() + 3000);
                }
                $_SESSION['is_login'] = true;
                $_SESSION['users_login'] = $username;
                redirect();
            } else {
                $error['login'] = "Tài khoản hoặc MK không chính xác";
            }
        }
    }
    load_view("login");
}

function regAction() {
//    date_default_timezone_set("Asia/Ho_Chi_Minh");
//    echo(date("H:i:s d-m-Y", time()));
//    show_array(date("H:i:s d-m-Y",check_date()));
    //==================================================================
    global $error, $emails, $username, $fullname, $password;
    if (isset($_POST["btn_reg"])) {
        $error = array();
        if (empty($_POST['fullname'])) {
            $error['fullname'] = 'Không được để trống fullname';
        } else {
            $fullname = $_POST['fullname'];
        }
        if (empty($_POST['email'])) {
            $error['email'] = 'Không được để trống email';
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = 'email không đúng định dang';
            } else {
                $emails = $_POST['email'];
            }
        }
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
            $active_token = md5($username . time());
            if (!users_exits($username, $emails)) {
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'email' => $emails,
                    'token_active' => $active_token,
                    'password' => $password
                );
                add_users($data);
                $link_active = base_url("?mod=users&action=active&token_active={$active_token}");
                $content = "<p>Vui lòng click vào link sau để kích hoạt {$link_active}</p>" .
                        "<p>Nếu không phải người đăng kí thì vui lòng không click vào link trên</p>";
                sent_mail("{$emails}", "{$fullname}", 'Link kích hoạt tài khoản', $content);
                redirect("?mod=users&action=login");
            } else {
                $error['btn_reg'] = 'username hoặc email đã tồn tại trong hệ thống';
            }
        }
    };

    load_view("reg");
}

function activeAction() {
    $acitve_token = $_GET['token_active'];
    $base = base_url('?mod=users&action=login');
    if (check_active($acitve_token)) {
        active_users($acitve_token);
        echo "tài khoản đã kích hoạt thành công click vào link sau để quay về: <a href='$base'>quay về</a>";
    } else {
        echo "tài khoản kích hoạt không thành công click vào link sau để quay về: <a href='$base'>quay về</a>";
    }
}

function resetpassAction() {
    global $error, $email, $password;
    $reset_token = @$_GET['reset_token'];
    if (!empty($reset_token)) {
        if (check_reset_token($reset_token)) {
            if (isset($_POST['btn_changle'])) {
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
                    update_password($data, $reset_token);
                    redirect("?mod=users&action=resetOK");
                }
            }
        } else {
            $error['btn_changle'] = "Yêu cầu lấy lại mật khẩu không hợp lệ";
        }
        load_view('reset_password');
    } else {
        if (isset($_POST['btn_reset'])) {
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
                    $reset_token = md5("$email" . time());
                    $base_url = base_url("?mod=users&action=resetpass&reset_token={$reset_token}");
                    $data = array(
                        'reset_token' => $reset_token,
                    );
                    check_reset_email($data, $email);
                    $content = "<p>Vui lòng click vào link sau để thay đổi mật khẩu: {$base_url}</p>";
                    sent_mail($email, '', "ĐẶT LẠI MẬT KHẨU", $content);
                } else {
                    $error['reset_email'] = "email không tồn tại trong hệ thống";
                }
            }
        }
        load_view("reset_pass");
    }
}

function resetOKAction() {
    load_view('resetOK');
}

function logoutAction() {
    load_view('logout');
}
