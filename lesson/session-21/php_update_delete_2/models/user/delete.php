<?php 
$id = $_GET['id'];
//$sql ="delete from `tbl_user` where `id` = {$id}";
//if(mysqli_query($conn, $sql)){
//    redirect("?model=user&act=main");
//}
if(db_delete("tbl_user", "`id` = {$id}")){
    redirect("?model=user&act=main");
}



