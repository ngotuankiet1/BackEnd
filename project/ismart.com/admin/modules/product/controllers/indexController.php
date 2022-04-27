<?php

function construct()
{
    load_model('index');
    load("helper", "images");
}

function indexAction()
{
    load_view("list_product");
}

//ADD
function add_productAction()
{
    global $error, $product_name, $product_code, $product_slug, $price_new, $price_old, $desc, $content, $file, $brand, $status, $num_product;
    if (isset($_POST['btn-submit'])) {
        $error = array();

        //product name
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "không được để trống";
        } else {
            $product_name = $_POST["product_name"];
        }

        //product code
        if (empty($_POST['product_code'])) {
            $error['product_code'] = "không được để trống";
        } elseif(is_exist("tbl_product",'product_code',$_POST['product_code'])){
            $error['product_code'] = "Đã tồn tại trong dữ liệu";
        }else{
             $product_code = $_POST["product_code"];
        }

        //slug
        if (empty($_POST['product_slug'])) {
            $error['product_slug'] = "không được để trống";
        } else {
            $product_slug = create_slug($_POST['product_slug']);
        }

        //price new
        if (empty($_POST['price_new'])) {
            $error['price_new'] = "không được để trống";
        } else {
            $price_new = $_POST["price_new"];
        }

        //price old
        if (empty($_POST['price_old'])) {
            $error['price_old'] = "không được để trống";
        } else {
            $price_old = $_POST["price_old"];
        }

        //num product
        if (empty($_POST['num_product'])) {
            $error['num_product'] = "không được để trống";
        } else {
            $num_product = $_POST["num_product"];
        }

        //desc
        if (empty($_POST['desc'])) {
            $error['desc'] = "không được để trống";
        } else {
            $desc = $_POST["desc"];
        }

        //content
        if (empty($_POST['content'])) {
            $error['content'] = "không được để trống";
        } else {
            $content = $_POST["content"];
        }

        //status
        if (empty($_POST['status'])) {
            $error['status'] = "không được để trống";
        } else {
            $status = $_POST["status"];
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


        //parent cat
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "không được để trống";
        } else {
            $parent_cat = $_POST["parent_cat"];
        }

        //brand
        if (empty($_POST['brand'])) {
            $error['brand'] = "không được để trống";
        } else {
            $brand = $_POST["brand"];
        }

        if (empty($error)) {
            // if (is_login() && check_role($_SESSION['users_login']) == 1) {
            //     $status = 'Approved';
            // } else {
            //     $status = 'Waitting...';
            // }
            $creator = get_admin_info($_SESSION['users_login']);
            $images = upload_image("public/images/files/product/", $type);
            $data = array(
                'product_code' => $product_code,
                'product_name' => $product_name,
                'slug' => $product_slug,
                'price_new' => $price_new,
                'price_old' => $price_old,
                'num_product' => $num_product,
                'product_desc' => $desc,
                'product_content' => $content,
                'images' => $images,
                'select_brand' => $brand,
                'parent_cat' => $parent_cat,
                'status' => $status,
                'creator' => $creator,
                'date' => date("d/m/Y"),
            );
            add_product($data);
            $error['product'] = "Thêm sản phẩm mới thành công" . "<br>" . "<a href='?mod=product&action=index'>Trở về danh sách sản phẩm</a>";
        }
    }
    load_view('add_product');
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
                            update_product($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_product');
                        } else {
                            load_view('list_product');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_product');
                        } else {
                            load_view('list_product');
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
                            update_product($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_product');
                        } else {
                            load_view('list_product');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_product');
                        } else {
                            load_view('list_product');
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
                            update_product($data, $admin_id);
                        }

                        if (isset($_GET['value'])) {
                            load_view('search_product');
                        } else {
                            load_view('list_product');
                        }
                    } else {
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('search_product');
                        } else {
                            load_view('list_product');
                        }
                    }
                }
            }else {
                $error['select'] = 'Bạn chưa lựa chọn tác vụ';
                if (isset($_GET['value'])) {
                    load_view('search_product');
                } else {
                    load_view('list_product');
                }
            }
        } else {
            $error['select'] = "Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('search_product');
            } else {
                load_view('list_product');
            }
        }
    }
}


function delete_productAction()
{
    $id = $_GET['id_product'];
    db_delete("tbl_product", "`product_id` = $id");
    redirect("?mod=product");
}

//search product
function search_pageAction()
{
    global $error, $value;
    $error = array();
    if (isset($_GET['sm_s'])) {
        if (!empty($_GET['value'])) {
            load_view('search_product');
        } else {
            $error['search'] = "Vui lòng nhập giá trị tìm kiếm!";
            load_view('list_product');
        }
    }
}

function update_productAction()
{
    $product_id = $_GET['id_product'];
    global $error, $product_name, $product_code, $product_slug, $price_new, $price_old, $desc, $content, $file, $brand, $status, $num_product;
    if (isset($_POST['btn-submit'])) {
        $error = array();
        $data = array();
        //product name
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "không được để trống";
        } else {
            $data['product_name'] = $_POST["product_name"];
        }

        //product code
        if (empty($_POST['product_code'])) {
            $error['product_code'] = "không được để trống";
        } else {
            $data['product_code'] = $_POST["product_code"];
        }

        //slug
        if (empty($_POST['product_slug'])) {
            $error['product_slug'] = "không được để trống";
        } else {
            $data['slug'] = create_slug($_POST['product_slug']);
        }

        //price new
        if (empty($_POST['price_new'])) {
            $error['price_new'] = "không được để trống";
        } else {
            $data['price_new'] = $_POST["price_new"];
        }

        //price old
        if (empty($_POST['price_old'])) {
            $error['price_old'] = "không được để trống";
        } else {
            $data['price_old'] = $_POST["price_old"];
        }

        //num product
        if (empty($_POST['num_product'])) {
            $error['num_product'] = "không được để trống";
        } else {
            $data['num_product'] = $_POST["num_product"];
        }

        //desc
        if (empty($_POST['desc'])) {
            $error['desc'] = "không được để trống";
        } else {
            $data['product_desc'] = $_POST["desc"];
        }

        //content
        if (empty($_POST['content'])) {
            $error['content'] = "không được để trống";
        } else {
            $data['product_content'] = $_POST["content"];
        }

        //status
        if (empty($_POST['status'])) {
            $error['status'] = "không được để trống";
        } else {
            $data['status'] = $_POST["status"];
        }

        // check upload file
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_images($type, $size)) {
                $error['upload_image'] = "Kích thước hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = info_product('images', $product_id);
                if (!empty($old_thumb)) {
                    delete_image($old_thumb);
                    $avatar = upload_image('public/images/files/product/', $type);
                    $data['images'] = $avatar;
                } else {
                    $avatar = upload_image('public/images/files/product/', $type);
                    $data['images'] = $avatar;
                }
            }
        } else {
            $avatar = info_product('images', $product_id);
            $data['images'] = $avatar;
        }

        //parent cat
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "không được để trống";
        } else {
            $data['parent_cat'] = $_POST["parent_cat"];
        }

        //brand
        if (empty($_POST['brand'])) {
            $error['brand'] = "không được để trống";
        } else {
            $data['select_brand'] = $_POST["brand"];
        }

        if (empty($error)) {
            $data['editor'] = get_admin_info($_SESSION['users_login']);
            $data['edit_date'] = date("d/m/Y");
            if (!empty($data)) {
                update_product($data, $product_id);
                $error['success'] = "Cập nhật thành công";
            } else {
                $error['success'] = "Cập nhật không thành công";
            }
        }
    }
    load_view("update_product");
}

function result_searchAction()
{
    global $value;
    if (!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('search_product');
}
