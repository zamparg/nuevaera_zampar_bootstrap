<?php

/*-------------------------------------------------

	Form Processor Plugin
	by SemiColonWeb

---------------------------------------------------*/


/*-------------------------------------------------
	PHPMailer Initialization Files
---------------------------------------------------*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


/*-------------------------------------------------
	Receiver's Email
---------------------------------------------------*/

$toemails = array();

$toemails[] = array(
				'email' => 'zamparg@hotmail.com', // Your Email Address  
				'name' => 'Nueva Era - Servicios Integrales' // Your Name
			);


/*-------------------------------------------------
	Sender's Email
---------------------------------------------------*/

$fromemail = array(
				'email' => $_POST["email"], // Company's Email Address (preferably currently used Domain Name)
				'name' => $_POST["nombre"] // Company Name
			);


/*-------------------------------------------------
	reCaptcha
---------------------------------------------------*/

// Add this only if you use reCaptcha with your Contact Forms
$recaptcha_secret = ''; // Your reCaptcha Secret


/*-------------------------------------------------
	PHPMailer Initialization
---------------------------------------------------*/

$mail = new PHPMailer();

/* Add your SMTP Codes after this Line */


// End of SMTP


/*-------------------------------------------------
	Form Processor
---------------------------------------------------*/

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

	$prefix		= !empty( $_POST['prefix'] ) ? $_POST['prefix'] : '';
	$submits	= $_POST["index-form"];
	
	$nombre		= $_POST["nombre"];
	$telefono	= $_POST["telefono"];
	$email		= $_POST["email"];
	$barrio		= $_POST["barrio"];
	$mensaje	= $_POST["presupuesto"];


	/*-------------------------------------------------
		Form Messages
	---------------------------------------------------*/

	$message = array(
		'success'			=> 'Hemos <strong>exitosamente</strong> recibido su mensaje y le responderemos lo antes posible.',
		'error'				=> 'El correo electrónico <strong>no pudo</strong> enviarse debido a un error inesperado. Por favor, inténtelo de nuevo más tarde.',
		'error_unexpected'	=> 'Se produjo un <strong> error inesperado </strong>. Por favor, inténtelo de nuevo más tarde.',
	);


	$message_form					= !empty( $submits['message'] ) ? $submits['message'] : array();
	$message['success']				= !empty( $message_form['success'] ) ? $message_form['success'] : $message['success'];
	$message['error']				= !empty( $message_form['error'] ) ? $message_form['error'] : $message['error'];
	$message['error_unexpected']	= !empty( $message_form['error_unexpected'] ) ? $message_form['error_unexpected'] : $message['error_unexpected'];
	
	$mail->Subject = $asunto;
	$mail->SetFrom( $fromemail['email'] , $fromemail['name'] );
	
	foreach( $toemails as $toemail ) {
		$mail->AddAddress( $toemail['email'] , $toemail['name'] );
	}
	
	$html_before = '<table class="full-width-container" border="0 " cellpadding="0" cellspacing="0" height="100%" width="100%" bgcolor="#eeeeee" style="width: 100%; height: 100%; padding: 50px 0 50px 0;">
				<tr>
					<td align="center" valign="top">
						<!-- / 700px container -->
						<table class="container" border="0" cellpadding="0" cellspacing="0" width="84%" bgcolor="#ffffff" style="width: 84%;">
							<tr>
								<td align="center" valign="top">
									';

	$html_after = '<!-- /// Footer -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>';

	$html = $html_before . '
	
									<table class="container header" border="0" cellpadding="0" cellspacing="0" width="84%" style="width: 84%;">
										<tr>
											<td style="padding: 30px 0 30px 0; border-bottom: solid 1px #eeeeee; font-size: 30px; font-weight: bold; text-decoration: none; color: #000000;" align="left">
												Contacto desde la web.
											</td>
										</tr>
									</table>
									<!-- /// Header -->

									<!-- / Hero subheader -->
									<table class="container hero-subheader" border="0" cellpadding="0" cellspacing="0" width="84%" style="width: 84%; padding: 60px 0 30px 0;">
										
										<tr>
										<td class="hero-subheader__title" style="font-size: 16px; line-height: 24px; font-weight: bold; padding: 0 0 5px 0;" align="left">
										Nombre:
										</td>
										</tr> 
										<tr>
										<td class="hero-subheader__content" style="font-size: 16px; line-height: 24px; color: #777777; padding: 0 15px 30px 0;" align="left">'.$nombre.'</td>
										</tr>
										
										<tr>
										<td class="hero-subheader__title" style="font-size: 16px; line-height: 24px; font-weight: bold; padding: 0 0 5px 0;" align="left">
										E-mail:</td>
										</tr> 
										<tr>
										<td class="hero-subheader__content" style="font-size: 16px; line-height: 24px; color: #777777; padding: 0 15px 30px 0;" align="left">'.$email.'</td>
										</tr>
										
										<tr>
										<td class="hero-subheader__title" style="font-size: 16px; line-height: 24px; font-weight: bold; padding: 0 0 5px 0;" align="left">Teléfono:</td>
										</tr> 
										<tr>
										<td class="hero-subheader__content" style="font-size: 16px; line-height: 24px; color: #777777; padding: 0 15px 30px 0;" align="left">'.$telefono.'</td>
										</tr>
										
										<tr>
										<td class="hero-subheader__title" style="font-size: 16px; line-height: 24px; font-weight: bold; padding: 0 0 5px 0;" align="left">Barrio:</td>
										</tr> 
										<tr>
										<td class="hero-subheader__content" style="font-size: 16px; line-height: 24px; color: #777777; padding: 0 15px 30px 0;" align="left">'.$barrio.'</td>
										</tr>
										
							
										<tr>
										<td class="hero-subheader__title" style="font-size: 16px; line-height: 24px; font-weight: bold; padding: 0 0 5px 0;" align="left">Mensaje:</td>
										</tr> 
										<tr>
										<td class="hero-subheader__content" style="font-size: 16px; line-height: 24px; color: #777777; padding: 0 15px 30px 0;" align="left">'.$mensaje.'</td>
										</tr>
										
									</table>

									<!-- / Footer -->
									<table class="container" border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
										<tr>
											<td align="center">
												<table class="container" border="0" cellpadding="0" cellspacing="0" width="84%" align="center" style="border-top: 1px solid #eeeeee; width: 84%;">
													<tr>
														<td style="color: #d5d5d5; text-align: center; font-size: 12px; padding: 30px 0 30px 0; line-height: 22px;">' . strip_tags( $referrer ) . '</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									' . $html_after;

		$body = $html;
	
	$mail->MsgHTML($body);
	$sendEmail = $mail->Send();


	if( $sendEmail == true ):

		if( $autores && !empty( $replyto_e ) ) {
			$send_arEmail = $autoresponder->Send();
		}

		echo '{ "alert": "success", "message": "' . $message['success'] . '" }';
	else:
		echo '{ "alert": "error", "message": "' . $message['error'] . '<br><br><strong>Razón:</strong><br>' . $mail->ErrorInfo . '" }';
	endif;

} else {
	echo '{ "alert": "error", "message": "' . $message['error_unexpected'] . '" }';
}

	/*-------------------------------------------------
		Auto-Responders
	---------------------------------------------------*/

?>