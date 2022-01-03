<?php

//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //số 0 sẽ không hiện thông tin chi tiết số 2 sẽ hiện thông tin chi tiết trên giao diện
    $mail->isSMTP();                                            //Gửi bằng SMTP 
    $mail->Host = 'smtp.gmail.com';                     //máy chủ google
    $mail->SMTPAuth = true;                                   //Bật xác thực SMTP 
    $mail->Username = 'ngotuankiet693@gmail.com';                     //tài khoản người gửi
    $mail->Password = 'chaurong';                               //mk người gửi
    $mail->SMTPSecure = 'tls';            //Bật mã hóa TLS ngầm định
    $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->CharSet = 'UTF-8';
    //
    //Recipients
    $mail->setFrom('ngotuankiet693@gmail.com', 'kietdz');  //tk người gửi và tên người gửi(từ dặt)
    $mail->addAddress('ngokiet688@gmail.com', 'ngokiet');     //tk người nhận và tên người đặt
//    $mail->addAddress('ngokiet68@gmail.com');               //thêm tài khoản người nhận
    $mail->addReplyTo('ngotuankiet693@gmail.com', 'kietdz'); //tài khoản người người nhận trả lời cho người gửi
//    $mail->addCC('cc@example.com');  //CC người nhận có thể nhìn thấy list người nhận khác
//    $mail->addBCC('ngokiet688@gmail.com');  //CC người nhận không thể nhìn thấy list người nhận khác
    /* -------------------------------------------------------------- */
    //Attachments(tệp đính kèm)
//    $mail->addAttachment('Capture.PNG');         //Add attachments(thêm tệp đính kèm)
//    $mail->addAttachment('Capture.PNG', 'usercase');    //Optional name(thêm tên tệp đính kèm)
    //Content
    $mail->isHTML(true);                                  //Đặt định dạng email thành HTML
    $mail->Subject = 'lân gửi thứ 1 text phpmailer';  //tiêu đề email
    $mail->Body = 'gửi lần 3 <b>kietdz</b>'; //nội dung html email
//    $mail->AltBody = 'Đây là phần nội dung ở dạng văn bản thuần túy cho các ứng dụng thư không phải HTML';
    $mail->send();
    echo 'Đã gửi thành công';
} catch (Exception $e) {
    echo "Gửi thất bại.Xem Chi tiết: {$mail->ErrorInfo}";
}