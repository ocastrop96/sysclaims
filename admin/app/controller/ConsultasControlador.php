<?php
class ConsultasControlador
{
    static public function ctrListarConsultas($item, $valor)
    {
        $rptListCS = ConsultasModelo::mdlListarConsultas($item, $valor);
        return $rptListCS;
    }
}
