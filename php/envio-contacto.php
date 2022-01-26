<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
$mail = new PHPMailer();

$mail->IsSMTP();                                      // set mailer to

$mail->Host = "mail.mmgdesigns.com.ar";  // specify main and backup server
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "contacto@nuevaeraservicios.com.ar";  // SMTP username
$mail->Password = "PASSWORD"; // SMTP password

// PRUEBA

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$barrio = $_POST['barrio'];
$servicio = $_POST['servicio'];
$otrostrabajos = $_POST['encuesta'];
$presupuesto = $_POST['comentario'];
$archivo = $_FILES['archivo'];

$message = "<b>Nueva solicitud de contacto enviada el:</b>" . date('d/m/Y', time()) . "<br><br>" ;
$message .= "<b>Nombre:</b> " . $nombre . " \r\n <br>";
$message .= "<b>E-mail: </b>" . $email . " \r\n <br>";
$message .= "<b>Teléfono: </b>" . $telefono . " \r\n <br>";
$message .= "<b>Vive en: </b>" . $barrio . " \r\n <br>";
$message .= "<b>¿Ya realizó trabajos con nosotros?: </b>" . $otrostrabajos . " \r\n <br>";
$message .= "<b>Solicita: </b>" . $servicio . " \r\n <br>";
$message .= "<b>Mensaje: </b>" . $presupuesto . " \r\n <br>";

if(isset($_POST["submit"]))
{
$path = 'upload/' . $_FILES["archivo"]["name"];
move_uploaded_file($_FILES["archivo"]["tmp_name"], $path); }

//FIN DE PRUEBA

$mail->From = $email;
$mail->FromName = $nombre;        // remitente
$mail->AddAddress("contacto@nuevaeraservicios.com.ar", "destinatario");        // destinatario

$mail->AddReplyTo($email);    // responder a

$mail->WordWrap = 50;     // set word wrap to 50 characters
$mail->IsHTML(true);     // set email



$mail->Subject = "Nueva solicitud de Presupuesto";
$mail->Body    = utf8_decode($message);
$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
$mail->AddAttachment($path);


if(!$mail->Send())
{
   echo "El mensaje no se ha podido enviar, intente nuevamente<p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}
header("location:../secciones/contacto-enviado.html");
//echo "Message has been sent";
?> 