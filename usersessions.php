<?php


session_start();
require_once 'db/config.php';

if (!isset($_SESSION['u'])) {
    header('Location: loging.php');
    exit();
}
?>