<?php


include "./credenciales.php";


$objPersona= new stdclass;
$objPersona->usuario=$_POST["usuario"];
$objPersona->contra=$_POST["contra"];

$persona ="";



function autenticacion($usuario,$contra)
{

    include "./credenciales.php";
    
    $respuesta_estado = "";

        try
        {
            $dsn = "mysql:host=$host;dbname=$base_de_datos_nombre";
            $dbh = new PDO($dsn,$user,$password);
            $respuesta_estado = $respuesta_estado . "\nconexion exitosa \n";
        }catch (PDOException $e) {
                $respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
        }


        $sql="select * from LISTA";

        $stmt = $dbh->prepare($sql);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->execute();

        $articulos=[];
        While($fila = $stmt->fetch()) {
                    $objArticulo = new stdClass();
                    $objArticulo->USUARIO=$fila['USUARIO'];
                    $objArticulo->CONTRA=$fila['CONTRA'];
                    $objArticulo->ADMIN=$fila['ADMIN'];
                    array_push($articulos,$objArticulo);
        }

        $dbh = null;
        global $persona;

        global $usuarios;
        $usuarios= count($articulos);

        foreach ($articulos as $objArticulo) {

            if($objArticulo->ADMIN == "Admin")
            {
                $persona = "Admin";
            }else
            {
                $persona = "USUARIO";
            }

            if($objArticulo->CONTRA == $contra && $objArticulo->USUARIO == $usuario)
            {
                return true;
                
            }
        }

}


if(!autenticacion($objPersona->usuario,sha1($objPersona->contra)))
{
    echo "<p>Conexion No Exitosa<p>";
    exit();
}


session_start();

$_SESSION['ejer08idsesion'] = session_create_id();

$_SESSION["usuario"] = $objPersona->usuario;
$_SESSION["persona"] = $persona;


if($_SESSION["persona"] == "Admin")
{
    echo "<p><button onClick=\"location.href='./eje_11/index.php'\">Ingrese a la aplicación ABM</button><p>";
    echo "<p><button onClick=\"location.href='./destruir.php'\">Terminar Sesion</button><p>";
}else
{
    echo "<p><button onClick=\"location.href='./menu_compra/index.php'\">Ingrese al menu de compra</button><p>";
    echo "<p><button onClick=\"location.href='./destruir.php'\">Terminar Sesion</button><p>";
}
echo "<p>su usuario es " . $_SESSION["usuario"] ." Y usted es " . $_SESSION["persona"] . "</p>";

?>