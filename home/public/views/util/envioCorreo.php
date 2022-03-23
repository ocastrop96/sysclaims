<?php
// require_once "../../../app/models/dbConnect.php";
// require_once "../../../app/controllers/utilitariosController.php";
// require_once "../../../app/models/utilitariosModel.php";

// require "./../../views/util/phpmailer/Exception.php";

// require "./../../views/util/phpmailer/PHPMailer.php";
// require "./../../views/util/phpmailer/SMTP.php";
// require "./../../views/util/tcpdf/tcpdf.php";

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

class EnvioCorreo
{
    static public function sndEnviarCorreo($codigo, $tdoc)
    {
        // $FHLarga = date('H:i:s');
        // $FHora = date('H');
        // $FMin = date('i');
        // $FAM = date('A');
        // $tipoParametro = 1;
        // $parametros = ControllerReclamo::ctrListarParametros($tipoParametro);

        // $mail = new PHPMailer(true);

        // try {
        //     //Server settings
        //     $mail->SMTPDebug = 0;                      //Enable verbose debug output
        //     $mail->isSMTP();                                            //Send using SMTP
        //     $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
        //     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        //     $mail->Username   = 'libroreclamacioneshnseb@outlook.com';                     //SMTP username
        //     $mail->Password   = 'Sistemas2021+-+@';                               //SMTP password
        //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        //     $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //     $mail->setFrom($parametros["correoParametro"], $parametros["detalleParametro"]);
        //     $mail->addAddress($parametros["correoParametro"]);
        //     // $mailUsuario2->addReplyTo('libroreclamaciones@hnseb.gob.pe', 'Libro de Reclamaciones en Salud Virtual-HNSEB');
        //     $mail->Subject = "Información de Registro de Reclamo en Salud Virtual-HNSEB";
        //     $mail->isHTML(true);
        //     $mail->CharSet = "utf-8";
        //     $mail->Body = "hola";
        //     $mail->send();
        //     echo 'Message has been sent';
        // } catch (Exception $e) {
        //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        // }
    }
}
