<?php


session_start();
if(!isset($_SESSION['usuario']))
{
    header("Location: login.php");
}
else if ($_SESSION['persona'] == "Admin")
{
    header("Location: ./eje_11/index.php");
}else
{
    header("Location: ./menu_compra/index.php");
    //aca iria el menu de compra
}





?>