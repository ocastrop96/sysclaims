<?php
require_once "../../../app/controller/ConsultasControlador.php";
require_once "../../../app/model/ConsultasModelo.php";

class DatatableConsultas
{
    public function mostrarTablaConsultas()
    {
        $item = null;
        $valor = null;
        $consultas = ConsultasControlador::ctrListarConsultas($item, $valor);

        $datos_json = '{
            "data": [';

        for ($i = 0; $i < count($consultas); $i++) {
            if (($consultas[$i]["estadoDoc"] == 1)) {
                $estado = "<button type='button' class='btn btn-block btn-secondary btnResponderConsulta' idConsulta='" . $consultas[$i]["idConsulta"] . "'><i class='fas fa-folder-plus'></i> " . $consultas[$i]["descEstadoDoc"] . "</button>";
            } elseif (($consultas[$i]["estadoDoc"] == 2)) {
                $estado = "<button type='button' class='btn btn-block btn-success'><i class='fas fa-check'></i> " . $consultas[$i]["descEstadoDoc"] . " </button>";
            }

            $botones = "<div class='btn-group'><button class='btn btn-warning btnVerConsulta' idConsulta='" . $consultas[$i]["idConsulta"] . "' data-toggle='modal' data-target='#modal-editar-consulta'><i class='fas fa-print'></i></button><button class='btn btn-info btnVerRespuestaConsulta' idConsulta='" . $consultas[$i]["idConsulta"] . "' data-toggle='modal' data-target='#modal-ver-respuestaCons'><i class='fas fa-eye'></i></button></div>";

            $datos_json .= '[
                "' . ($i + 1) . '",
                "' . $consultas[$i]["correlativoCon"] . '",
                "' . $consultas[$i]["fechaCon"] . '",
                "' . $consultas[$i]["abrvTipDoc"] . '-' . $consultas[$i]["nDoc"] . '",
                "' . $consultas[$i]["nombresAp"] . '",
                "' . $consultas[$i]["email"] . '",
                "' . $estado . '",
                "' . $botones . '"
            ],';
        }
        $datos_json = substr($datos_json, 0, -1);
        $datos_json .= ']
        }';
        echo $datos_json;
    }
}

$tablaConsultas = new DatatableConsultas();
$tablaConsultas->mostrarTablaConsultas();
