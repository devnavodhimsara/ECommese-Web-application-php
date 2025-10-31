<?php

include "db\connections.php";

$username = $_POST["u"];
$email = $_POST["e"];
$phone_number = $_POST["pn"];
$message = $_POST["mg"];
if (empty($username)) {
    echo ("please enter your name.");
} else if (empty($email)) {
    echo ("please enter your email address");
} else if (empty($phone_number)) {
    echo ("please enter yourphone number");
} else if (empty($message)) {
    echo ("please enter your message");
} else {

    Database::iud("INSERT INTO `contact_messages`
        (`name`,`email`,`phone`,`message`) VALUES 
        ('" . $username . "','" . $email . "','" . $phone_number . "','" . $message . "')");

    echo ("success");
}
