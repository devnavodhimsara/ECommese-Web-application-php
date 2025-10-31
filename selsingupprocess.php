<?php

include "db\connections.php";

$username = $_POST["u"];
$email = $_POST["e"];
$password = $_POST["p"];

$status = 1;


if(empty($username)){
    echo ("please enter your username.");
}else if(empty($email)){
    echo ("please enter your email address");

}else if(empty($password)){
    echo("please enter your password");
}else{

    $rs = Database::search("SELECT * FROM `sellers` WHERE `username`='".$username."' OR `email`='".$email."'");
    $n = $rs->num_rows;

    if($n > 0){
        echo ("User with the same Email Address or same username already exists.");
    }else{



        Database::iud("INSERT INTO `sellers`
        (`username`,`email`,`password`,`status`) VALUES 
        ('".$username."','".$email."','".$password."','".$status."')");

        echo ("success");

    }

}

?>