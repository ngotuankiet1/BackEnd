<?php
#Lấy datatype "text"
$price = $_POST['price'];
$num_order = $_POST['num_order'];

$total = $price * $num_order;

echo $total;

#Lấy datatype "json"
//$price = $_POST['price'];
//$num_order = $_POST['num_order'];
//
//$total = $price * $num_order;
//
//$result = array(
//    'price' => $price,
//    'num_order' => $num_order,
//    'total' => $total,
//);
//
//echo json_encode($result);