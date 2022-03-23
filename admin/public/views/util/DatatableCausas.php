<?php
require_once "../../../app/controller/CausasControlador.php";
require_once "../../../app/model/CausasModelo.php";

class DatatableCausas
{
    public function mostrarTablaCausas()
    {
        $item = null;
        $valor = null;
        $causas = CausasControlador::ctrListarCausas($item, $valor);

        $datos_json = '{
            "data": [';

        for ($i = 0; $i < count($causas); $i++) {
            if (($causas[$i]["estadoItemCE"] != 2)) {
                $estado = "<button type='button' class='btn btn-block btn-success btnActivarCausa' idCausa='" . $causas[$i]["idCausaEsp"] . "' idEstado='2'><i class='fas fa-user-check'></i>ACTIVO</button>";
            } else {
                $estado = "<button type='button' class='btn btn-block btn-danger btnActivarCausa' idCausa='" . $causas[$i]["idCausaEsp"] . "' idEstado='1'><i class='fas fa-user-minus'></i>INACTIVO</button>";
            }

            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarCausa' idCausa='" . $causas[$i]["idCausaEsp"] . "' data-toggle='modal' data-target='#modal-editar-Causa'><i class='fas fa-edit'></i></button><button class='btn btn-danger btnEliminarCausa' data-toggle='tooltip' data-placement='left' title='Eliminar Causa' idCausa='" . $causas[$i]["idCausaEsp"] . "'><i class='fas fa-trash-alt'></i></button></div>";

            $datos_json .= '[
                "' . ($i + 1) . '",
                "' . $causas[$i]["descCausaEsp"] . '",
                "' . $causas[$i]["descDerechoSal"] . '",
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

$tablaCausas = new DatatableCausas();
$tablaCausas->mostrarTablaCausas();
