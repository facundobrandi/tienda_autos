<?php

include("./manejoSesion.inc.php");

include "../credenciales.php";

$respuesta_estado = "";


$objPersona= new stdclass;
$objPersona->orden=$_GET["Modelo"];


try
{
     $dsn = "mysql:host=$host;dbname=$base_de_datos_nombre";
     $dbh = new PDO($dsn,$user,$password);
     $respuesta_estado = $respuesta_estado . "\nconexion exitosa";
}catch (PDOException $e) {
        $respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
    }

    $sql = "delete from datos_2 where MODELO=:modelo;";

    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(':modelo', $objPersona->orden);

    $stmt->execute();

    $dbh = null;
    echo $objPersona->orden;



?>