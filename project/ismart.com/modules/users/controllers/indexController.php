<?php

function construct() {
    load_model('index');
}

function loginAction() {
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
                redirect();
            } else {
                $error['login'] = "Tài khoản hoặc MK không chính xác";
            }
        }
    }
    load_view('login');
}

function logoutAction() {
    load_view('logout');
}

function regAction() {
//    date_default_timezone_set("Asia/Ho_Chi_Minh");
//    echo(date("H:i:s d-m-Y", time()));
//    show_array(date("H:i:s d-m-Y",check_date()));
    //==================================================================
    global $error, $username, $fullname, $email, $password;
    if (isset($_POST["btn-reg"])) {
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
                $email = $_POST['email'];
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
            if (!users_exits($username, $email)) {
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'active_token' => $active_token,
                    'reg_date' => time(),
                );
                add_user($data);
                $link_active = base_url("?mod=users&action=active&active_token={$active_token}");
                $content = "<p>Vui nhấn vào link này để kích hoạt tài khoản: {$link_active}<p>"
                        . "<p>Nếu không phải bạn đăng kí vui lòng bỏ qua email này<p>";
                sent_mail("{$email}", "{$fullname}", 'Link kích hoạt tài khoản', $content);
                redirect("?mod=users&action=login");
            } else {
                $error['btn-reg'] = "email hoặc username đã tồn tại";
            }
        }
    }
    load_view("reg");
}

function activeAction() {
    $active_token = $_GET['active_token'];
    $base_login = base_url("?mod=users&action=login");
    if (check_active($active_token)) {
        active_user($active_token);
        echo "Kích hoạt thành công vui lòng lick để về trang đăng nhập: <a href='{$base_login}'>Click</a>";
    } else {
        echo "Tài khoản không thể kích hoạt hoặc đã kích hoạt thành công: <a href='{$base_login}'>Click</a>";
    }
}

function resetpassAction() {
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

function resetOKAction() {
    load_view('resetOK');
}
