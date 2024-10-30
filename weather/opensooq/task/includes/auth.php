<?php 
    if (strlen($_SESSION['userlogin']) == 0) {
        header('Location: ../page/login.php');
        exit();
    }
?>