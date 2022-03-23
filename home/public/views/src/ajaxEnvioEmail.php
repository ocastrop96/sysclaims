<?php
require_once "../../../app/controllers/reclamosController.php";
require_once "../../../app/models/reclamosModel.php";

require "./../../views/util/phpmailer/Exception.php";
require "./../../views/util/phpmailer/PHPMailer.php";
require "./../../views/util/phpmailer/SMTP.php";
require "./../../views/util/tcpdf/tcpdf.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ajaxEnvioCorreo
{
    public $codigoReclamo;
    public function ajaxEnviarCorreo()
    {
        $codeRec = $this->codigoReclamo;
        // Listar Parametros -->> AQUI CARGAMOS LOS PARAMETROS DE LA BASE DE DATOS CON RESPECTO AL CORREO DEL LIBRO DE RECLAMOS.
        $parametrosLibro = ControllerReclamo::ctrListarParametros(1);
        // Listar Parametros

        // Cargar datos a partir del código autogenerado -->> $codeRec
        $dataReclamos = ControllerReclamo::ctrCargarHojaReclamo($codeRec);
        // Cargar datos a partir del código autogenerado -->> $codeRec

        // CONDICIONALES DEPENDIENDO DE QUIEN PRESENTA EL RECLAMO

        // Usuario Afectado Presenta Reclamo => $dataReclamos["regsRep"] = 2
        if ($dataReclamos['regsRep'] == 2) {
            $bodyMailUser = $dataReclamos['correlativo'];
            $emailUser = $dataReclamos['email'];
            $subjectUser =  $parametrosLibro['detalleParametro'];

            $bodyMailOffice = "<h1>" . $dataReclamos['correlativo'] . "</h1>";
            $emailOffice = $parametrosLibro['correoParametro'];
            $subjectOffice = $parametrosLibro['detalleParametro2'];

            $mailUser = new PHPMailer(true);
            // $mailOffice = new PHPMailer(true);

            try {
                $mailUser->SMTPDebug = 0;
                $mailUser->isSMTP();
                $mailUser->Host = 'smtp-mail.outlook.com';
                $mailUser->SMTPAuth = true;
                $mailUser->Username = 'libroreclamacioneshnseb@outlook.com';
                $mailUser->Password = 'Sistemas2021+-+@';
                $mailUser->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mailUser->Port = 587;

                // $mailOffice->SMTPDebug = 0;
                // $mailOffice->isSMTP();
                // $mailOffice->Host = 'smtp-mail.outlook.com';
                // $mailOffice->SMTPAuth = true;
                // $mailOffice->Username = 'libroreclamacioneshnseb@outlook.com';
                // $mailOffice->Password = 'Sistemas2021+-+@';
                // $mailOffice->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                // $mailOffice->Port = 587;

                // Armado de correo
                // Correo Envío de Correo para Usuario
                $mailUser->setFrom("libroreclamacioneshnseb@outlook.com", $parametrosLibro['detalleParametro']);

                $mailUser->addAddress($emailUser);
                $mailUser->addReplyTo($emailOffice, $parametrosLibro['detalleParametro']);
                $mailUser->Subject = $subjectUser;
                // $mailUser->addStringAttachment($reclamoPDF2, $corre2 . '.pdf');
                // $mailUser->isHTML(true);
                // $mailUser->CharSet = "utf-8";
                $mailUser->Body = $bodyMailUser;
                $mailUser->send();

                // Correo Envío de Correo para Usuario

                // // Correo Envío de Correo para Oficina Calidad
                // $mailOffice->setFrom($parametrosLibro["correoParametro"], $parametrosLibro["detalleParametro"]);

                // // $mailOffice->setFrom($parametrosLibro["correoParametro"], $parametrosLibro["detalleParametro"]);

                // $mailOffice->addAddress($emailOffice);
                // $mailOffice->Subject = $subjectOffice;
                // // $mailOffice->addStringAttachment($reclamoPDF2, $corre2 . '.pdf');
                // $mailOffice->isHTML(true);
                // $mailOffice->CharSet = "utf-8";
                // $mailOffice->Body = $bodyMailOffice;
                // // Correo Envío de Correo para Oficina Calidad

                // // Send Mails
                // $mailOffice->send();
                // Send Mails

                // Armado de correo
            } catch (Exception $e) {
                echo "Hubo un error al enviar: {$mailUser->ErrorInfo}";
                // echo "Hubo un error al enviar: {$mailOffice->ErrorInfo}";
            }
        }
        // Usuario Afectado Presenta Reclamo => $dataReclamos["regsRep"] = 2

        // Representante Usuario Afectado Presenta Reclamo => $dataReclamos["regsRep"] = 1
        elseif ($dataReclamos["regsRep"] == 1) {
            $bodyMailUserR = "<h1>" . $dataReclamos["correlativo"] . "</h1>";
            $emailUserR = $dataReclamos["emailRep"];
            $subjectUserR =  $parametrosLibro["detalleParametro"];

            $bodyMailOffice = "<h1>" . $dataReclamos["correlativo"] . "</h1>";
            $emailOffice = $parametrosLibro["correoParametro"];
            $subjectOffice = $parametrosLibro["detalleParametro2"];

            $mailUser = new PHPMailer(true);
            $mailOffice = new PHPMailer(true);

            try {
                $mailUser->SMTPDebug = 0;
                $mailUser->isSMTP();
                $mailUser->Host = 'smtp-mail.outlook.com';
                $mailUser->SMTPAuth = true;
                $mailUser->Username = 'libroreclamacioneshnseb@outlook.com';
                $mailUser->Password = 'Sistemas2021+-+@';
                $mailUser->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mailUser->Port = 587;

                $mailOffice->SMTPDebug = 0;
                $mailOffice->isSMTP();
                $mailOffice->Host = 'smtp-mail.outlook.com';
                $mailOffice->SMTPAuth = true;
                $mailOffice->Username = 'libroreclamacioneshnseb@outlook.com';
                $mailOffice->Password = 'Sistemas2021+-+@';
                $mailOffice->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mailOffice->Port = 587;

                // Armado de correo
                // Correo Envío de Correo para Usuario
                $mailUser->setFrom($parametrosLibro["correoParametro"], $parametrosLibro["detalleParametro"]);
                $mailUser->addAddress($emailUserR);
                $mailUser->addReplyTo('libroreclamaciones@hnseb.gob.pe', 'Libro de Reclamaciones en Salud Virtual-HNSEB');
                $mailUser->Subject = $subjectUserR;
                // $mailUser->addStringAttachment($reclamoPDF2, $corre2 . '.pdf');
                $mailUser->isHTML(true);
                $mailUser->CharSet = "utf-8";
                $mailUser->Body = $bodyMailUserR;
                // Correo Envío de Correo para Usuario

                // Correo Envío de Correo para Oficina Calidad
                $mailOffice->setFrom($parametrosLibro["correoParametro"], $parametrosLibro["detalleParametro"]);
                $mailOffice->addAddress($emailOffice);
                $mailOffice->Subject = $subjectOffice;
                // $mailOffice->addStringAttachment($reclamoPDF2, $corre2 . '.pdf');
                $mailOffice->isHTML(true);
                $mailOffice->CharSet = "utf-8";
                $mailOffice->Body = $bodyMailOffice;
                // Correo Envío de Correo para Oficina Calidad

                // Send Mails
                $mailUser->send();
                $mailOffice->send();
                // Send Mails

                // Armado de correo
            } catch (Exception $e) {
                echo "Hubo un error al enviar: {$mailUser->ErrorInfo}";
                echo "Hubo un error al enviar: {$mailOffice->ErrorInfo}";
            }
        }
        // Representante Usuario Afectado Presenta Reclamo => $dataReclamos["regsRep"] = 1

        // CONDICIONALES DEPENDIENDO DE QUIEN PRESENTA EL RECLAMO
        // 
        // $cuerpoOficina = "<h1>".$dataReclamos["detalleReclamo"]."</h1>";
        // $destinoOficina = $parametros["correoParametro"];
        // $asuntoOficina = "Información de Registro de Reclamo en Salud Virtual-HNSEB";
        // $mailOficina1 = new PHPMailer(true);

        // try {
        //     $mailOficina1->SMTPDebug = 0;
        //     $mailOficina1->isSMTP();
        //     $mailOficina1->Host = 'smtp-mail.outlook.com';
        //     $mailOficina1->SMTPAuth = true;
        //     $mailOficina1->Username = 'libroreclamacioneshnseb@outlook.com';
        //     $mailOficina1->Password = 'Sistemas2021+-+@';
        //     $mailOficina1->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //     $mailOficina1->Port = 587;

        //     // Recipientes
        //     $mailOficina1->setFrom("libroreclamacioneshnseb@outlook.com", $parametros["detalleParametro"]);
        //     $mailOficina1->addAddress($destinoOficina);
        //     $mailOficina1->Subject = $asuntoOficina;
        //     $mailOficina1->isHTML(true);
        //     $mailOficina1->CharSet = "utf-8";
        //     $mailOficina1->Body = $cuerpoOficina;
        //     $mailOficina1->send();
        // } catch (Exception $e) {
        //     echo "Hubo un error al enviar: {$mailOficina1->ErrorInfo}";
        // }

        // echo 1;
    }
}

$EnvioCorreo = new ajaxEnvioCorreo();
$EnvioCorreo->codigoReclamo = $_POST["codigoReclamo"];
$EnvioCorreo->ajaxEnviarCorreo();
