<?php
session_start();
include "db\connections.php";

$user = $_POST["u"];
$password= $_POST["p"];


if(empty($user)){
    echo ("Please Enter Your username.");
}else if(empty($password)){
    echo ("Please Enter Your Password.");
}else{

    $rs = Database::search("SELECT * FROM `sellers`");
    $n = $rs->num_rows;

    if($n == 1){

      
        $d = $rs->fetch_assoc();
        $_SESSION["sup1"] = $d;


    }else{
        echo ("Invalid Username or Password.");
    }

}

?>