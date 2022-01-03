<?php
if (isset($_POST['btn-login'])) {
    echo $_POST['detail'];
}
?>
<html>
    <style>
        #wrapper{
            width: 960px;
            margin: 0px auto;
        }
        h1{
            text-align: center;
        }
    </style>
    <head>
        <title>Ckeditor</title>
        <script src="ckeditor/ckeditor.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <h1>CKEDITOR</h1>
            <form method="post">
                <textarea class="ckeditor" name="detail"></textarea>
                <input type="submit" name="btn-login" value="Thêm thông tin">
            </form>
        </div>
    </body>
</html>

