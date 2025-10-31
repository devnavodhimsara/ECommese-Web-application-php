<?php

session_start();

if (isset($_SESSION["sup"])) {


    $_SESSION["sup"] = null;
    session_destroy();

    echo ("success");
}


?>