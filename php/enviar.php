<?php
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$barrio = $_POST['presupuesto'];
$presupuesto = $_POST['presupuesto'];

$header = 'From: ' . $email . " \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain";

$message = "Este mensaje fue enviado por: " . $nombre . " \r\n";
$message .= "Su e-mail es: " . $email . " \r\n";
$message .= "Teléfono de contacto: " . $telefono . " \r\n";
$message .= "Vive en: " . $barrio . " \r\n";
$message .= "Mensaje: " . $_POST['presupuesto'] . " \r\n";
$message .= "Enviado el: " . date('d/m/Y', time());

$para = 'zamparg@hotmail.com';
$asunto = 'Solicitud de presupuesto';

$enviado = mail($para, $asunto, utf8_decode($message), $header);

if ($enviado)
header("Location:../index.html");
else
header("location:error.html")
?>