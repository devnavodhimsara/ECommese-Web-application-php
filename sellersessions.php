<?php


session_start();
require_once 'db/config.php';

if (!isset($_SESSION['username'])) {
    header('Location: sellersingin.php');
    exit();
}
?>