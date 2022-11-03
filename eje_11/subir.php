<?php
include("./manejoSesion.inc.php");
include "../credenciales.php";

$respuesta_estado = "";

$data = $_POST["modelo"];

$contenidoPdf = file_get_contents($_FILES['documentoPdf']['tmp_name']);

try
{
     $dsn = "mysql:host=$host;dbname=$base_de_datos_nombre";
     $dbh = new PDO($dsn,$user,$password);
     $respuesta_estado = $respuesta_estado . "\nconexion exitosa";
}catch (PDOException $e) {
        $respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
    }

    $sql="update datos set PDF=:pdf where MODELO=:modelo;";

    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(':modelo', $data);
    $stmt->bindParam(':pdf', $contenidoPdf);

    $stmt->execute();

    $dbh = null;

    echo $respuesta_estado;

?>