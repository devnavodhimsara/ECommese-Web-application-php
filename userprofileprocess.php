<?php

session_start();
include "db\connections.php";

$email =  $_SESSION["u"]["email"];
       $fname = $_POST["fname"];
       $lname=$_POST["lname"];
       $ad1= $_POST["ad1"];
       $ad2=$_POST["ad2"];
  
$user_rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."'");


if(empty($ad1)){
    echo ("please enter your address.");
}else if(empty($ad2)){
    echo ("please enter your address");

}else

if($user_rs->num_rows == 1){

    Database::iud("UPDATE `users` SET `first_name`='".$fname."',`last_name`='".$lname."',`address_line1`='".$ad1."',`address_line2`='".$ad2."' WHERE 
    `email`='".$email."'");

    if(sizeof($_FILES) == 1){

        $image = $_FILES["i"];
        $image_extension = $image["type"];

        $allowed_image_extensions = array("image/jpeg","image/png","image/svg+xml");

        if(in_array($image_extension,$allowed_image_extensions)){
            $new_img_extension;

            if($image_extension == "image/jpeg"){
                $new_img_extension = ".jpeg";
            }else if($image_extension == "image/png"){
                $new_img_extension = ".png";
            }else if($image_extension == "image/svg+xml"){
                $new_img_extension = ".svg";
            }

            $file_name = "navod".$email."_".uniqid().$new_img_extension;
            move_uploaded_file($image["tmp_name"],$file_name);

            $profile_img_rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."'");

            if($profile_img_rs->num_rows == 1){

                Database::iud("UPDATE `users` SET `profile_image`='".$file_name."' WHERE `email`='".$email."'");
                echo ("Updated");

            }else{

                Database::iud("INSERT INTO `users`(`profile_image`,`email`) VALUES ('".$file_name."','".$email."')");
                echo ("Saved");

            }

        }


    }else if(sizeof($_FILES) == 0){

        echo ("updated your profile.");

    }else{
        echo ("You must select only 01 profile image.");
    }

}else{
    echo ("Invalid user.");
}

?>