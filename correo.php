<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//require "vendor/autoload.php"; 
require "vendor/phpmailer/phpmailer/src/Exception.php";
require "vendor/phpmailer/phpmailer/src/PHPMailer.php";
require "vendor/phpmailer/phpmailer/src/SMTP.php";
   
class Correo{


	//implementamos nuestro constructor
public function __construct(){
 
}

public function enviar_correo($correo, $asunto, $descripcion) {
    
    
    $mail = new PHPMailer(true);
    
    //Server settings
     
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'esesuroccidente.sistemas@gmail.com';                     //SMTP username
    $mail->Password   = 'fwkuwklayzxcixgn';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('esesuroccidente.sistemas@gmail.com', 'ventanilla unica');
    $mail->addAddress($correo, $correo);     //Add a recipient
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $descripcion;
    $mail->send();
    

}


}



 ?> 