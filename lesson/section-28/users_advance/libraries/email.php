<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sent_mail($sent_to_mail, $name, $subject, $content, $project = array()) {
    global $config;
    $config_email = $config['email'];
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //số 0 sẽ không hiện thông tin chi tiết số 2 sẽ hiện thông tin chi tiết trên giao diện
        $mail->isSMTP();                                            //Gửi bằng SMTP 
        $mail->Host = $config_email['smtp_host'];                     //máy chủ google
        $mail->SMTPAuth = true;                                   //Bật xác thực SMTP 
        $mail->Username = $config_email['smtp_user'];                     //tài khoản người gửi
        $mail->Password = $config_email['smtp_pass'];                               //mk người gửi
        $mail->SMTPSecure = $config_email['SMTPSecure'];            //Bật mã hóa TLS ngầm định
        $mail->Port = $config_email['smtp_port'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = 'UTF-8';
        //
        //Recipients
        $mail->setFrom($config_email['smtp_user'], $config_email['Fullname']);  //tk người gửi và tên người gửi(từ dặt)
        $mail->addAddress($sent_to_mail, $name);     //tk người nhận và tên người đặt
//    $mail->addAddress('ngokiet68@gmail.com');               //thêm tài khoản người nhận
        $mail->addReplyTo($config_email['smtp_user'], $config_email['Fullname']); //tài khoản người người nhận trả lời cho người gửi
//    $mail->addCC('cc@example.com');  //CC người nhận có thể nhìn thấy list người nhận khác
//    $mail->addBCC('ngokiet688@gmail.com');  //CC người nhận không thể nhìn thấy list người nhận khác
        /* -------------------------------------------------------------- */
        //Attachments(tệp đính kèm)
//        $mail->addAttachment($project);
//        $mail->addAttachment('Capture.PNG', 'usercase'); //Optional name(thêm tên tệp đính kèm)
        //Content
        $mail->isHTML(true);                                  //Đặt định dạng email thành HTML
        $mail->Subject = $subject;  //tiêu đề email
        $mail->Body = $content; //nội dung html email
//    $mail->AltBody = 'Đây là phần nội dung ở dạng văn bản thuần túy cho các ứng dụng thư không phải HTML';
        $mail->send();
//        echo 'Đã gửi thành công';
    } catch (Exception $e) {
        echo "Gửi thất bại.Xem Chi tiết: {$mail->ErrorInfo}";
    }
}
