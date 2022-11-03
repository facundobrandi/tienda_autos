<?php
    session_start();
    if(!isset($_SESSION['usuario']) or $_SESSION['persona'] != "Admin")
    {
        header("Location: ../login.php");
    }

?>