



<?php



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



try
{
     $dsn = "mysql:host=$host;dbname=$base_de_datos_nombre";
     $dbh = new PDO($dsn,$user,$password);
     $respuesta_estado = $respuesta_estado . "\nconexion exitosa";
}catch (PDOException $e) {
        $respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
    }


    // ESTO FUNCIONA SOLO PARA ORDENAR POR UN COLUMNA $sql="select * from datos order by " . $objPersona->orden;
    $sql="select * from datos_2";

    //$sql = "SELECT *  FROM `datos` WHERE `MODELO` = \':modelo\' ORDER BY `MODELO` ASC";


    //$sql = "SELECT *  FROM `datos` WHERE `MODELO` LIKE \':modelo\' AND `PRECIO` LIKE \'275000\' AND `PATENTE` LIKE \'AAA-111\' AND `FECHA` LIKE \'2023-04-05\' AND `PAIS` LIKE \'FRANCIA\' AND `CANT` LIKE \'2\' ORDER BY `MODELO` ASC";


$stmt = $dbh->prepare($sql);

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