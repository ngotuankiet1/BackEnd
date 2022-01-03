<?php
if (isset($_POST['btn_add'])) {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";


//    if (isset($_POST['cat'])) {
        #c1
//        foreach ($_POST['cat'] as $value) {
//            echo $value . "<br>";
//        }

        #c2
//        $list_cat = implode(',', $_POST['cat']);
//        echo $list_cat;
//    }
}
?>


<html>
    <body>
        <form action="" method="post">
            <input type="checkbox" name="cat[]" value="thể thao" id="cat1">
            <label for="cat1">thể thao</label> <br>
            <input type="checkbox" name="cat[]" value="xã hội" id="cat2">
            <label for="cat2">xã hội</label> <br>
            <input type="submit" name="btn_add" value="Thêm Bài Viết">
        </form>
    </body>
</html>
