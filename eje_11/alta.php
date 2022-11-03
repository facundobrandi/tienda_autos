<?php

include("./manejoSesion.inc.php");

include "../credenciales.php";

$respuesta_estado = "";


$objPersona= new stdclass;
$objPersona->f_modelo=$_POST["modelo_carga"];
$objPersona->f_precio=$_POST["precio_carga"];
$objPersona->f_patente=$_POST["patente_carga"];
$objPersona->f_fecha=$_POST["fecha_carga"];
$objPersona->f_pais=$_POST["pais_carga"];
$objPersona->f_cantidad=$_POST["puertas_carga"];
$objPersona->f_ruta=$_POST["ruta_carga"];


try
{
     $dsn = "mysql:host=$host;dbname=$base_de_datos_nombre";
     $dbh = new PDO($dsn,$user,$password);
     $respuesta_estado = $respuesta_estado . "\nconexion exitosa \n";
}catch (PDOException $e) {
        $respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
}

    $sql="insert into datos_2 (MODELO,PRECIO,PATENTE,FECHA,PAIS,CANT,RUTA)
    values (:modelo,:precio,:patente,:fecha,:pais,:cantidad,:ruta);";
    
    try {
        $stmt = $dbh->prepare($sql);
        $respuesta_estado = $respuesta_estado . "\nPreparacion exitosa!  \n";
        } catch (PDOException $e) {
        $respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
    }
    
    try {
        $stmt->bindParam(':modelo', $objPersona->f_modelo);
        $stmt->bindParam(':precio', $objPersona->f_precio);
        $stmt->bindParam(':patente', $objPersona->f_patente);
        $stmt->bindParam(':fecha', $objPersona->f_fecha);
        $stmt->bindParam(':pais', $objPersona->f_pais);
        $stmt->bindParam(':cantidad', $objPersona->f_cantidad);
        $stmt->bindParam(':ruta', $objPersona->f_ruta);
        $respuesta_estado = $respuesta_estado . "\nBinding exitoso! \n";
        } catch (PDOException $e) {
        $respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
    }
    
    try {
        $stmt->execute();
        $respuesta_estado = $respuesta_estado . "\nEjecucion exitosa!  \n";
        } catch (PDOException $e) {
        $respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
    }

    $dbh = null;

echo $respuesta_estado;
    
    




?>