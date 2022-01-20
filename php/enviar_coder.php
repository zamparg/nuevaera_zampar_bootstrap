<?php
$destino= "yourdreamswebsite@gmail.com";
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$comentarios = $_POST["comentarios"];

$contenido = "Nombre: "  . $nombre . "\nApellido: "  . $apellido ."\nCorreo: " .$correo. "\nTelefono: " . $telefono . "\nComentarios: " .$comentarios;
    
    
mail($destino,"contacto",$contenido);
header("location:gracias.html");
?>