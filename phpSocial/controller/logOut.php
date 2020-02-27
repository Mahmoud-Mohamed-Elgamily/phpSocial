<?php
    session_start();
    session_destroy();
    header("Location:/phpSocial/views/authentication/login.php");
?>