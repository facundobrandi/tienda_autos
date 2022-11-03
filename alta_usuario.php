<?php

include "./credenciales.php";

$respuesta_estado = "";


$objPersona= new stdclass;
$objPersona->usuario=$_POST["usuario"];
$objPersona->contra=sha1($_POST["contra"]);


        try
        {
            $dsn = "mysql:host=$host;dbname=$base_de_datos_nombre";
            $dbh = new PDO($dsn,$user,$password);
            $respuesta_estado = $respuesta_estado . "\nconexion exitosa \n";
        }catch (PDOException $e) {
                $respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
        }

    $sql="insert into LISTA (USUARIO,CONTRA)
    values (:usu,:contra);";
    
    try {
        $stmt = $dbh->prepare($sql);
        $respuesta_estado = $respuesta_estado . "\nPreparacion exitosa!  \n";
        } catch (PDOException $e) {
        $respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
    }
    
    try {
        $stmt->bindParam(':usu', $objPersona->usuario);
        $stmt->bindParam(':contra', $objPersona->contra);
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
echo $respuesta_estado;

?>