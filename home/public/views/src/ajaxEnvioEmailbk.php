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
        // Listar Parametros
        $parametros = ControllerReclamo::ctrListarParametros(1);

        $dataReclamos = ControllerReclamo::ctrCargarHojaReclamo($codeRec);
        // Listar Parametros
        $cuerpoOficina = "<h1>".$dataReclamos['correlativo']."</h1>";
        $destinoOficina = $parametros["correoParametro"];
        $asuntoOficina =  $parametros["detalleParametro"];
        $mailOficina1 = new PHPMailer(true);

        try {
            $mailOficina1->SMTPDebug = 0;
            $mailOficina1->isSMTP();
            $mailOficina1->Host = 'smtp-mail.outlook.com';
            $mailOficina1->SMTPAuth = true;
            $mailOficina1->Username = 'libroreclamacioneshnseb@outlook.com';
            $mailOficina1->Password = 'Sistemas2021+-+@';
            $mailOficina1->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mailOficina1->Port = 587;

            // Recipientes
            $mailOficina1->setFrom("libroreclamacioneshnseb@outlook.com", $parametros["detalleParametro"]);
            $mailOficina1->addAddress($destinoOficina);
            $mailOficina1->addReplyTo($dataReclamos['email'], $parametros['detalleParametro']);
            $mailOficina1->Subject = $asuntoOficina;
            $mailOficina1->isHTML(true);
            $mailOficina1->CharSet = "utf-8";
            $mailOficina1->Body = $cuerpoOficina;
            $mailOficina1->send();
        } catch (Exception $e) {
            echo "Hubo un error al enviar: {$mailOficina1->ErrorInfo}";
        }

        echo 1;
    }
}

$EnvioCorreo = new ajaxEnvioCorreo();
$EnvioCorreo->codigoReclamo = $_POST["codigoReclamo"];
$EnvioCorreo->ajaxEnviarCorreo();
