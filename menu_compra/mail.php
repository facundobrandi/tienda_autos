
<?php
    $toEmail = $_GET["ma"];
    if(mail($toEmail,"Informacion de compra","informacion")) {
        echo "Su mail fue enviado";
    } else {
        echo  $toEmail;
    }
?>
