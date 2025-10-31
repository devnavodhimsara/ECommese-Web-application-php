<?php

include "db\connections.php";

$firstname = $_POST["f"];

$lastname= $_POST["l"];

$email= $_POST["e"];

$password=$_POST["p"];

$mobile = $_POST["m"];

$status = 1;


if(empty($firstname)){
    echo ("Please Enter Your First Name.");
}else if(strlen($firstname) > 50){
    echo ("First Name Must Contain LOWER THAN 50 characters.");
}else if(empty($lastname)){
    echo ("Please Enter Your Last Name.");
}else if(strlen($lastname) > 50){
    echo ("Last Name Must Contain LOWER THAN 50 characters.");
}else if(empty($email)){
    echo ("Please Enter Your Email Address.");
}else if(strlen($email) > 100){
    echo ("Email Address Must Contain LOWER THAN 100 characters.");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo ("Invalid Email Address.");
}else if(empty($password)){
    echo ("Please Enter Your Password.");
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo ("Password Must Contain 5 to 20 Characters.");
}else if(empty($mobile)){
    echo ("Please Enter Your Mobile Number.");
}else if(strlen($mobile) != 10){
    echo ("Mobile Number Must Contain 10 characters.");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/",$mobile)){
    echo ("Invalid Mobile Number.");
}else{

    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."' OR `mobile_number`='".$mobile."'");
    $n = $rs->num_rows;

    if($n > 0){
        echo ("User with the same Email Address or same Mobile Number already exists.");
    }else{



        Database::iud("INSERT INTO `users`
        (`first_name`,`last_name`,`email`,`password`,`mobile_number`,`status`) VALUES 
        ('".$firstname."','".$lastname."','".$email."','".$password."','".$mobile ."','".$status."')");

        echo ("success");

    }

}

?>