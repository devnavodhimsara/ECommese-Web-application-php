<?php

include "db\connections.php";

$email = $_POST["e"];
$newpw = $_POST["n"];
$retypepw = $_POST["r"];
$vcode = $_POST["v"];

if($newpw != $retypepw){
    echo ("Password does not match.");
}else{

    $rs = Database::search("SELECT * FROM `sellers` WHERE `email`='".$email."' AND `verification_code`='".$vcode."'");
    $num = $rs->num_rows;

    if($num == 1){

        Database::iud("UPDATE `sellers` SET `password`='".$retypepw."' WHERE `email`='".$email."'");
        echo ("success");

    }else{
        echo ("Invalid Email Address or Verification Code");
    }

}

?>