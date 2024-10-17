<?php
session_start();
unset($_SESSION['cur_login']);
header('location: ../BTN_PHP/login.php');
?>