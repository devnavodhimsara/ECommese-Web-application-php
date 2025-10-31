<?php

include "db\connections.php";

include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $email . "'");
    $n = $rs->num_rows;

    if ($n == 1) {

        // Generate a 6-digit random verification code
        $code = rand(10000, 99999);
        Database::iud("UPDATE `users` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nhanavodhimsara77@gmail.com';
        $mail->Password = 'cjromdsacvjtkgji';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('nhanavodhimsara77@gmail.com', 'Reset Password');
        $mail->addReplyTo('nhanavodhimsara77@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Nimsara Computers Forgot Password Verification Code';
        $bodyContent = '<button><h1 style="color:green;">Your Verification Code is</h1></button><h2 style="color:red;">' . $code . '</h2>';

        $mail->Body = $bodyContent;

        if (!$mail->send()) {
            echo 'Verification code sending failed.';
        } else {
            echo 'Success';
        }
    } else {
        echo ("Invalid Email Address.");
    }
} else {
    echo ("Please enter your Email Address in the Email Field.");
}
