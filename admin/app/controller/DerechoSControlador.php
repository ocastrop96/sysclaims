<?php
class DerechoSControlador
{
    static public function ctrListarDerechos($item, $valor)
    {
        $rptListDS = DerechoSModelo::mdlListarDerechoS($item, $valor);
        return $rptListDS;
    }
}
