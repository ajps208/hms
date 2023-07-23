<?php
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['admno']);
    session_destroy();
    header('Location:../index.html');
?>
