<?php
# lấy thông tin
$info = array(
    'id' => '1',
    'fullname' => "ngo tuan kiet",
    'Email' => 'ngokiet68@gmail.com',
);
#lấy sô nguyên tố
$list_prime = array(2, 3, 5, 7);
echo "số nguyên tố bé nhất là :{$list_prime[0]}";
?>

<html>
    <head>
        <title>Lấy thông tin của mảng</title>
    </head>
    <body>
        <p>id : <strong><?php echo $info['id']; ?></strong></p>
        <p>họ và tên : <strong><?php echo $info['fullname']; ?></strong></p>
        <p>Email : <strong><?php echo $info['Email']; ?></strong></p>
    </body>
</html>