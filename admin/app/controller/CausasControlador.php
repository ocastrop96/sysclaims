<?php
class CausasControlador
{
    static public function ctrListarCausas($item, $valor)
    {
        $rptListCS = CausasModelo::mdlListarCausas($item, $valor);
        return $rptListCS;
    }
}
