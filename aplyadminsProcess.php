<?php

include "db\connections.php";

$firstname = $_POST["fn"];

$lastname= $_POST["ln"];

$mobilenumber= $_POST["mn"];

$email=$_POST["email"];

$pw =$_POST["pw"];
$reson = $_POST["reson"];

$province = $_POST["province"];

$status = 2;

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
}else if(empty($pw)){

echo("please add a strong password");
}else if(empty($mobilenumber)){
    echo ("Please Enter Your Mobile Number.");
}else if(strlen($mobilenumber) != 10){
    echo ("Mobile Number Must Contain 10 characters.");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/",$mobilenumber)){
    echo ("Invalid Mobile Number.");
}else if(empty($reson)){
    echo("please type your resoneble answer");
}else if(empty($province)){
    echo("please type your province");
}else{
    $rs = Database::search("SELECT * FROM `aplyadmins` WHERE `email`='".$email."' OR `mobilenumber`='".$mobilenumber."'");
    $n = $rs->num_rows;


    if($n > 0){
        echo ("User with the same Email Address or same Mobile Number already exists.");
    }else{



        Database::iud("INSERT INTO `aplyadmins`
        (`fname`,`lname`,`mobilenumber`,`email`,`resons`,`provins`,`status`,`password`) VALUES 
        ('".$firstname."','".$lastname."','".$mobilenumber."','".$email."','".$reson."','".$province ."','".$status ."','".$pw ."')");

        echo ("success");

    }

}

?>