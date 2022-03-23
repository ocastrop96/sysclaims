<?php
class SugerenciasControlador
{
    static public function ctrListarSugerencias($item, $valor)
    {
        $rptListCS = SugerenciasModelo::mdlListarSugerencias($item, $valor);
        return $rptListCS;
    }
}
