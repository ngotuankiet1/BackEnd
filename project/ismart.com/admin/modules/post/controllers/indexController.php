<?php

function construct()
{
    load_model('index');
    load('helper', 'images');
}

function indexAction()
{
    load_view('list_post');
}

// ADD POST
function add_postAction()
{
    load_model('index_cat_post');
    global $error, $title, $slug, $file, $desc;
    if (isset($_POST['btn-submit'])) {
        $error = array();

        //title
        if (empty($_POST['title'])) {
            $error['title'] = "không được để trống title";
        } elseif (is_exist("tbl_post", "post_title", $_POST['title'])) {
            $error['title'] = "danh mục đã tồn tại trong hệ thống";
        } else {
            $title = $_POST["title"];
        }

        //slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "không được để trống slug";
        } elseif (is_exist("tbl_post", "slug", $_POST['slug'])) {
            $error['slug'] = "danh mục đã tồn tại trong hệ thống";
        } else {
            $slug = create_slug($_POST['slug']);
        }

        //desc
        if (empty($_POST['desc'])) {
            $error['desc'] = "không được để trống desc";
        } else {
            $desc = $_POST['desc'];
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


        if (empty($_POST['parent_cat'])) {
            $cat_parent = 0;
        } else {
            $cat_parent = $_POST['parent_cat'];
        }

        if (empty($error)) {
            if (is_login() && check_role($_SESSION['users_login']) == 1) {
                $post_status = 'Approved';
            } else {
                $post_status = 'Waitting...';
            }
            $creator = get_admin_info($_SESSION['users_login']);
            $images_post = upload_image("public/images/files/posts/", $type);
            $data = array(
                'post_title' => $title,
                'slug' => $slug,
                'creator' => $creator,
                'post_content' => $desc,
                'images' => $images_post,
                'cat_parent' => $cat_parent,
                'date' => date("d/m/Y"),
                'post_status' => $post_status,
                'cat_parent' => $cat_parent,
            );
            add_post($data);
            $error['post'] = "Thêm bài viết mới thành công" . "<br>" . "<a href='?mod=post&action=index'>Trở về danh sách danh mục</a>";
        }
    }
    load_view('add_post');
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
                            'post_status' => 'Approved',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_post($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_post');
                        } else {
                            load_view('list_post');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_post');
                        } else {
                            load_view('list_post');
                        }
                    }
                }
                //Chờ phê duyệt
                if ($_POST['actions'] == 2) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'post_status' => 'Waitting...',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_post($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_post');
                        } else {
                            load_view('list_post');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_post');
                        } else {
                            load_view('list_post');
                        }
                    }
                }

                //bỏ vào thùng rác
                if ($_POST['actions'] == 3) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'post_status' => 'Trash',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_post($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_post');
                        } else {
                            load_view('list_post');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_post');
                        } else {
                            load_view('list_post');
                        }
                    }
                }
            }else {
                $error['select'] = 'Bạn chưa lựa chọn tác vụ';
                if (isset($_GET['value'])) {
                    load_view('search_post');
                } else {
                    load_view('list_post');
                }
            }
        } else {
            $error['select'] = "Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('search_post');
            } else {
                load_view('list_post');
            }
        }
    }
}


//delete post
function delete_postAction()
{
    $id = $_GET['id_post'];
    db_delete('tbl_post', "`id` = '{$id}'");
    redirect("?mod=post");
}

//update post
function update_postAction()
{
    load_model('index_cat_post');
    if (isset($_GET['id_post'])) {
        $id_post = $_GET['id_post'];
        global $error, $title, $slug, $file, $desc;
        if (isset($_POST['btn-submit'])) {
            $error = array();
            $data = array();

            //title
            if (empty($_POST['title'])) {
                $error['title'] = "không được để trống title";
            } else {
                $data['post_title'] = $_POST["title"];
            }

            //slug
            if (empty($_POST['slug'])) {
                $error['slug'] = "không được để trống slug";
            } else {
                $data['slug'] = create_slug($_POST['slug']);
            }

            //desc
            if (empty($_POST['desc'])) {
                $error['desc'] = "không được để trống desc";
            } else {
                $data['post_content'] = $_POST['desc'];
            }

            // check upload file
            if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
                $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $size = $_FILES['file']['size'];
                if (!is_images($type, $size)) {
                    $error['upload_image'] = "Kích thước hoặc kiểu ảnh không đúng";
                } else {
                    $old_thumb = info_post('images', $id_post);
                    if (!empty($old_thumb)) {
                        delete_image($old_thumb);
                        $images = upload_image('public/images/files/posts/', $type);
                        $data['images'] = $images;
                    } else {
                        $images = upload_image('public/images/files/posts/', $type);
                        $data['images'] = $images;
                    }
                }
            } else {
                $images = info_post('images', $id_post);
                $data['images'] = $images;
            }


            if (empty($_POST['parent_cat'])) {
                $data['cat_parent'] = 0;
            } else {
                $data['cat_parent'] = $_POST['parent_cat'];
            }

            if (empty($error)) {
                if (!empty($data)) {
                    $creator = get_admin_info($_SESSION['users_login']);
                    $data['editor'] = $creator;
                    $data['edit_date'] = date("d/m/Y");
                    update_post($data, $id_post);
                    $error['success'] = "Cập nhật thành công";
                } else {
                    $error['success'] = "Cập nhật không thành công";
                }
            }
        }
    } else {
        echo "không tồn tại";
    }

    load_view("update_post");
}


//search cat post
function search_pageAction()
{
    global $error, $value;
    $error = array();
    if (isset($_GET['sm_s'])) {
        if (!empty($_GET['value'])) {
            load_view('search_post');
        } else {
            $error['search'] = "Vui lòng nhập giá trị tìm kiếm!";
            load_view('list_post');
        }
    }
}


function result_searchAction()
{
    global $value;
    if (!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('search_post');
}

