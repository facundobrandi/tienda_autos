

<?php
include("./manejoSesion.inc.php");

sleep(2);

// ESTE INCLUDE TIENE LOS DATOS DE LA BASE DE DATOS , 

/*$base_de_datos_nombre = "";
$host = "";
$user = "";
$password  =""; */


include "../credenciales.php";


$respuesta_estado = "";
$orden = "";



$objPersona= new stdclass;
$objPersona->orden=$_GET["orden"];
$objPersona->f_modelo=$_GET["f_modelo"];
$objPersona->f_precio=$_GET["f_precio"];
$objPersona->f_patente=$_GET["f_patente"];
$objPersona->f_fecha=$_GET["f_fecha"];
$objPersona->f_pais=$_GET["f_pais"];
$objPersona->f_cantidad=$_GET["f_cantidad"];



try
{
     $dsn = "mysql:host=$host;dbname=$base_de_datos_nombre";
     $dbh = new PDO($dsn,$user,$password);
     $respuesta_estado = $respuesta_estado . "\nconexion exitosa";
}catch (PDOException $e) {
        $respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
    }


    // ESTO FUNCIONA SOLO PARA ORDENAR POR UN COLUMNA $sql="select * from datos order by " . $objPersona->orden;
    $sql="select * from datos_2 where MODELO LIKE CONCAT('%',:modelo,'%') and ";
    $sql = $sql . "PRECIO like CONCAT('%',:precio,'%') and ";
    $sql = $sql . "PATENTE like CONCAT('%',:patente,'%') and ";
    $sql = $sql . "FECHA like CONCAT('%',:fecha,'%') and ";
    $sql = $sql . "PAIS like CONCAT('%',:pais,'%') and ";
    $sql = $sql . "CANT like CONCAT('%',:cantidad,'%') ";
    $sql = $sql . "order by "  . $objPersona->orden;

    //$sql = "SELECT *  FROM `datos` WHERE `MODELO` = \':modelo\' ORDER BY `MODELO` ASC";


    //$sql = "SELECT *  FROM `datos` WHERE `MODELO` LIKE \':modelo\' AND `PRECIO` LIKE \'275000\' AND `PATENTE` LIKE \'AAA-111\' AND `FECHA` LIKE \'2023-04-05\' AND `PAIS` LIKE \'FRANCIA\' AND `CANT` LIKE \'2\' ORDER BY `MODELO` ASC";



$stmt = $dbh->prepare($sql);



$stmt->bindParam(':modelo', $objPersona->f_modelo);
$stmt->bindParam(':precio', $objPersona->f_precio);
$stmt->bindParam(':patente', $objPersona->f_patente);
$stmt->bindParam(':fecha', $objPersona->f_fecha);
$stmt->bindParam(':pais', $objPersona->f_pais);
$stmt->bindParam(':cantidad', $objPersona->f_cantidad);


$stmt->setFetchMode(PDO::FETCH_ASSOC);

$stmt->execute();


$articulos=[];
While($fila = $stmt->fetch()) {
            $objArticulo = new stdClass();
            $objArticulo->MODELO=$fila['MODELO'];
            $objArticulo->PRECIO=$fila['PRECIO'];
            $objArticulo->PATENTE=$fila['PATENTE'];
            $objArticulo->FECHA=$fila['FECHA'];
            $objArticulo->PAIS=$fila['PAIS'];
            $objArticulo->CANT=$fila['CANT'];
            $objArticulo->RUTA=$fila['RUTA'];
            array_push($articulos,$objArticulo);
}



$objArticulos = new stdClass();

$objArticulos->articulos=$articulos;

$objArticulos->cuenta=count($articulos);

$salidaJson = json_encode($objArticulos);
$dbh = null;


echo $salidaJson;


?>