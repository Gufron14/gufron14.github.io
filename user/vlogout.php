<?php
    session_start();
    include '../config/conn.php';
    unset($_SESSION['voter_id']);
    unset($_SESSION['voter_name']);
    session_destroy();
    header("Location:../index.php", true, 301);
?>