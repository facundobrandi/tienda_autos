<?php 
    $objJSON = new stdClass();
    
    session_start();
    session_unset();
    session_destroy();

    if(!isset($_SESSION['usuario']))
    {
        //echo json_encode($objJSON,JSON_INVALID_UTF8_SUBSTITUTE);
        header("Location: index.php");
    }

?>