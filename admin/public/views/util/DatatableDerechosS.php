<?php
require_once "../../../app/controller/DerechoSControlador.php";
require_once "../../../app/model/DerechoSModelo.php";

class DatatableDerechosSal
{
    public function mostrarTablaDerechosSal()
    {
        $item = null;
        $valor = null;
        $derechosSal = DerechoSControlador::ctrListarDerechos($item, $valor);

        $datos_json = '{
            "data": [';

        for ($i = 0; $i < count($derechosSal); $i++) {
            if (($derechosSal[$i]["estadoItemDer"] != 2)) {
                $estado = "<button type='button' class='btn btn-block btn-success btnActivarDerecho' idDerecho='" . $derechosSal[$i]["idDerecho"] . "' idEstado='2'><i class='fas fa-user-check'></i>ACTIVO</button>";
            } else {
                $estado = "<button type='button' class='btn btn-block btn-danger btnActivarDerecho' idDerecho='" . $derechosSal[$i]["idDerecho"] . "' idEstado='1'><i class='fas fa-user-minus'></i>INACTIVO</button>";
            }

            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarDerecho' idDerecho='" . $derechosSal[$i]["idDerecho"] . "' data-toggle='modal' data-target='#modal-editar-derecho'><i class='fas fa-edit'></i></button><button class='btn btn-danger btnEliminarDerecho' data-toggle='tooltip' data-placement='left' title='Eliminar Derecho' idDerecho='" . $derechosSal[$i]["idDerecho"] . "'><i class='fas fa-trash-alt'></i></button></div>";

            $datos_json .= '[
                "' . ($i + 1) . '",
                "' . $derechosSal[$i]["descDerechoSal"] . '",
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

$tablaDerechosSal = new DatatableDerechosSal();
$tablaDerechosSal->mostrarTablaDerechosSal();
