

<?php

include("./manejoSesion.inc.php");
sleep(1);

// ESTE INCLUDE TIENE LOS DATOS DE LA BASE DE DATOS , 

/*$base_de_datos_nombre = "";
$host = "";
$user = "";
$password  =""; */


include "../credenciales.php";


$respuesta_estado = "";
$orden = "";



$objPersona= new stdclass;
$objPersona->f_modelo=$_GET["modelo"];

try
{
     $dsn = "mysql:host=$host;dbname=$base_de_datos_nombre";
     $dbh = new PDO($dsn,$user,$password);
     $respuesta_estado = $respuesta_estado . "\nconexion exitosa";
}catch (PDOException $e) {
        $respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
    }

    $sql="select RUTA from datos_2 where MODELO=:modelo";


$stmt = $dbh->prepare($sql);



$stmt->bindParam(':modelo', $objPersona->f_modelo);

$stmt->setFetchMode(PDO::FETCH_ASSOC);

$stmt->execute();


$articulos=[];
While($fila = $stmt->fetch()) {
            $objArticulo = new stdClass();
            $objArticulo->RUTA=$fila['RUTA'];
            array_push($articulos,$objArticulo);
}

$objArticulos = new stdClass();

$objArticulos->articulos=$articulos;

$objArticulos->cuenta=count($articulos);

$salidaJson = json_encode($objArticulo,JSON_INVALID_UTF8_SUBSTITUTE);
$dbh = null;


echo $salidaJson;


?>