<?php
class ControladorUtilitarios
{
    static public function ctrListarTipoDoc($opcion)
    {
        $respuesta = ModeloUtilitarios::mdlListarTipoDoc($opcion);
        return $respuesta;
    }
    
    static public function ctrListarTipoDocDetalle($opcion)
    {
        $respuesta = ModeloUtilitarios::mdlListarTipoDocDetalles($opcion);
        return $respuesta;
    }

    static public function ctrListarProvinciasxDep($opcion)
    {
        $respuesta = ModeloUtilitarios::mdlListarProvinciasxDep($opcion);
        return $respuesta;
    }

    static public function ctrListarDistritosxProv($opcion)
    {
        $respuesta = ModeloUtilitarios::mdlListarDistritosxProv($opcion);
        return $respuesta;
    }

    static public function ctrListarCausasxDerecho($opcion)
    {
        $respuesta = ModeloUtilitarios::mdlListarCausasxDerecho($opcion);
        return $respuesta;
    }


    static public function ctrListarTipSexo()
    {
        $respuesta = ModeloUtilitarios::mdlListarTipoSexo();
        return $respuesta;
    }

    static public function ctrListarDepartamento()
    {
        $respuesta = ModeloUtilitarios::mdlListarDepartamento();
        return $respuesta;
    }

    static public function ctrListarTiposUsuarios()
    {
        $respuesta = ModeloUtilitarios::mdlListarTiposUsuarios();
        return $respuesta;
    }

    static public function ctrListarDerechosSalud()
    {
        $respuesta = ModeloUtilitarios::mdlListarDerechosSalud();
        return $respuesta;
    }

    
}
