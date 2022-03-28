<?php
require_once "../../../app/controller/ReclamosControlador.php";
require_once "../../../app/model/ReclamosModelo.php";

class DatatableReclamos
{
    public function mostrarTablaReclamos()
    {
        $item = null;
        $valor = null;
        $reclamos = ReclamosControlador::ctrListarReclamos($item, $valor);

        $datos_json = '{
            "data": [';

        for ($i = 0; $i < count($reclamos); $i++) {
            if (($reclamos[$i]["estadoRec"] == 1)) {
                $estado = "<button type='button' class='btn btn-block btn-success btnResponderReclamo' idReclamo='" . $reclamos[$i]["idReclamo"] . "'><i class='fas fa-check'></i> " . $reclamos[$i]["descEstadoRec"] . "</button>";
            } elseif (($reclamos[$i]["estadoRec"] == 2)) {
                $estado = "<button type='button' class='btn btn-block btn-secondary'><i class='fas fa-spinner'></i> " . $reclamos[$i]["descEstadoRec"] . " </button>";
            } elseif (($reclamos[$i]["estadoRec"] == 3)) {
                $estado = "<button type='button' class='btn btn-block btn-warning'><i class='fas fa-dolly'></i> " . $reclamos[$i]["descEstadoRec"] . " </button>";
            } elseif (($reclamos[$i]["estadoRec"] == 4)) {
                $estado = "<button type='button' class='btn btn-block btn-danger'><i class='fas fa-archive'></i> " . $reclamos[$i]["descEstadoRec"] . " </button>";
            }
            elseif (($reclamos[$i]["estadoRec"] == 5)) {
                $estado = "<button type='button' class='btn btn-block btn-info'><i class='fas fa-sort-alpha-up-alt'></i> " . $reclamos[$i]["descEstadoRec"] . " </button>";
            }
            elseif (($reclamos[$i]["estadoRec"] == 6)) {
                $estado = "<button type='button' class='btn btn-block btn-primary'><i class='fas fa-list-alt'></i> " . $reclamos[$i]["descEstadoRec"] . " </button>";
            }
            $botones = "<div class='btn-group'><button class='btn btn-info btnVerReclamo' idReclamo='" . $reclamos[$i]["idReclamo"] . "' data-toggle='modal' data-target='#modal-editar-Causa'><i class='fas fa-print'></i></button><button class='btn btn-success btnVerRespuesta' idReclamo='" . $reclamos[$i]["idReclamo"] . "' data-toggle='modal' data-target='#modal-ver-respuesta'><i class='fas fa-eye'></i></button></div>";

            $datos_json .= '[
                "' . ($i + 1) . '",
                "' . $reclamos[$i]["correlativo"] . '",
                "' . $reclamos[$i]["fechaReclamo"] . '",
                "' . $reclamos[$i]["abrvTipDoc"] . '-' . $reclamos[$i]["nDoc"] . '",
                "' . $reclamos[$i]["razonSocial"] . ' '.$reclamos[$i]["nombres"] . ' ' . $reclamos[$i]["apellidoPat"] . ' ' . $reclamos[$i]["apellidoMat"] . '",
                "' . $estado . '",
                "' . $reclamos[$i]["descEtapa"] . '",
                "' . $reclamos[$i]["descResultado"] . '",
                "' . $botones . '"
            ],';
        }
        $datos_json = substr($datos_json, 0, -1);
        $datos_json .= ']
        }';
        echo $datos_json;
    }
}

$tablaReclamos = new DatatableReclamos();
$tablaReclamos->mostrarTablaReclamos();
