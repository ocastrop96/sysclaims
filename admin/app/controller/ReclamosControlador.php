<?php
class ReclamosControlador
{
    static public function ctrListarReclamos($item, $valor)
    {
        $rptListCS = ReclamosModelo::mdlListarReclamos($item, $valor);
        return $rptListCS;
    }
}
