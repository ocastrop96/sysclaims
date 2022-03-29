<?php
require_once "../../../app/controllers/utilitariosController.php";
require_once "../../../app/models/utilitariosModel.php";

class ajaxUtilitarios
{
    // Listar Detalles Tipo Doc
    public $idTipoDoc;
    public function ajaxListarDetalleTipoDoc()
    {
        $valor = $this->idTipoDoc;
        $respuesta = ControladorUtilitarios::ctrListarTipoDocDetalle($valor);
        echo json_encode($respuesta);
    }
    // Listar Detalles Tipo Doc

    // Listar Provicia por Departamento
    public $idDepartamento;
    public function ajaxListarProvinciasDep()
    {
        $valor = $this->idDepartamento;
        $respuesta = ControladorUtilitarios::ctrListarProvinciasxDep($valor);
        $totalData = count($respuesta);
        if ($totalData > 0) {
            $html = "<option value='0'>Seleccione Provincia</option>";
            foreach ($respuesta as $key => $value) {
                $html .= "<option value='$value[idProvincia]'>$value[descProvincia]</option>";
            }
        } else {
            $html = "<option value='0'>No hay provincias relacionadas</option>";
        }
        echo $html;
    }
    // Listar Provicia por Departamento

    // Listar Distrito por Provincia
    public $idProvincia;
    public function ajaxListarDistritosProv()
    {
        $valor = $this->idProvincia;
        $respuesta = ControladorUtilitarios::ctrListarDistritosxProv($valor);
        $totalData = count($respuesta);
        if ($totalData > 0) {
            $html = "<option value='0'>Seleccione Distrito</option>";
            foreach ($respuesta as $key => $value) {
                $html .= "<option value='$value[idDistrito]'>$value[descDistrito]</option>";
            }
        } else {
            $html = "<option value='0'>No hay distritos relacionados</option>";
        }
        echo $html;
    }
    // Listar Distrito por Provincia

    // Listar Causas Generales x Derecho
    public $idDerecho;
    public function ajaxListarCausasxDerecho()
    {
        $valor = $this->idDerecho;
        $respuesta = ControladorUtilitarios::ctrListarCausasxDerecho($valor);
        $totalData = count($respuesta);
        if ($totalData > 0) {
            $html = "<option value='0'>Seleccione la causa específica del reclamo</option>";
            foreach ($respuesta as $key => $value) {
                $html .= "<option value='$value[idCausaEsp]'>$value[descCausaEsp]</option>";
            }
        } else {
            $html = "<option value='0'>No hay distritos casusas relacionadas</option>";
        }
        echo $html;
    }
    // Listar Causas Generales x Derecho

}
// Listar Detalles Tipo Doc
if (isset($_POST["idTipoDoc"])) {
    $list2 = new ajaxUtilitarios();
    $list2->idTipoDoc = $_POST["idTipoDoc"];
    $list2->ajaxListarDetalleTipoDoc();
}
// Listar Detalles Tipo Doc

// Listar Provicia por Departamento
if (isset($_POST["idDepartamento"])) {
    $list3 = new ajaxUtilitarios();
    $list3->idDepartamento = $_POST["idDepartamento"];
    $list3->ajaxListarProvinciasDep();
}
// Listar Provicia por Departamento

// Listar Distrito por Provincia
if (isset($_POST["idProvincia"])) {
    $list4 = new ajaxUtilitarios();
    $list4->idProvincia = $_POST["idProvincia"];
    $list4->ajaxListarDistritosProv();
}
// Listar Distrito por Provincia

// Listar Causas Generales x Derecho
if (isset($_POST["idDerecho"])) {
    $list5 = new ajaxUtilitarios();
    $list5->idDerecho = $_POST["idDerecho"];
    $list5->ajaxListarCausasxDerecho();
}
// Listar Causas Generales x Derecho