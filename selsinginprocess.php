<?php
session_start();
include "db\connections.php";

$email = $_POST["e"];
$password= $_POST["p"];


if(empty($email)){
    echo ("Please Enter Your email address.");
}else if(empty($password)){
    echo ("Please Enter Your Password.");
}else{

    $rs = Database::search("SELECT * FROM `sellers` WHERE `email`='".$email."' AND `password`='".$password."'AND `status`='1'");
    $n = $rs->num_rows;

    if($n == 1){

        echo ("success");
        $d = $rs->fetch_assoc();
        $_SESSION["sup"] = $d;


    }else{
        echo ("Invalid email address or Password.");
    }

}

?>