<?php
namespace gamboamartin\comisiones\instalacion;

use config\generales;
use gamboamartin\administrador\instalacion\_adm;
use gamboamartin\administrador\models\_instalacion;
use gamboamartin\cat_sat\models\cat_sat_clase_producto;
use gamboamartin\cat_sat\models\cat_sat_conf_imps;
use gamboamartin\cat_sat\models\cat_sat_conf_imps_tipo_pers;
use gamboamartin\cat_sat\models\cat_sat_conf_reg_tp;
use gamboamartin\cat_sat\models\cat_sat_cve_prod;
use gamboamartin\cat_sat\models\cat_sat_division_producto;
use gamboamartin\cat_sat\models\cat_sat_forma_pago;
use gamboamartin\cat_sat\models\cat_sat_grupo_producto;
use gamboamartin\cat_sat\models\cat_sat_metodo_pago;
use gamboamartin\cat_sat\models\cat_sat_moneda;
use gamboamartin\cat_sat\models\cat_sat_motivo_cancelacion;
use gamboamartin\cat_sat\models\cat_sat_producto;
use gamboamartin\cat_sat\models\cat_sat_regimen_fiscal;
use gamboamartin\cat_sat\models\cat_sat_tipo_impuesto;
use gamboamartin\cat_sat\models\cat_sat_tipo_persona;
use gamboamartin\cat_sat\models\cat_sat_tipo_producto;
use gamboamartin\cat_sat\models\cat_sat_tipo_relacion;
use gamboamartin\cat_sat\models\cat_sat_unidad;
use gamboamartin\errores\errores;
use gamboamartin\plugins\Importador;
use PDO;
use stdClass;

class instalacion
{
    private function _add_comi_comision(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (NEW _instalacion($link))->create_table_new(table:'comi_comision');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al crear comi_comision', data: $create);
        }

        $out->create = $create;

        return $out;
    }

    private function _add_comi_conf_comision(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (NEW _instalacion($link))->create_table_new(table:'comi_conf_comision');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al crear comi_conf_comision', data: $create);
        }

        $out->create = $create;

        return $out;
    }

    private function _add_comi_rel_comision_factura(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (NEW _instalacion($link))->create_table_new(table:'comi_rel_comision_factura');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al crear comi_rel_comision_factura', data: $create);
        }

        $out->create = $create;

        return $out;
    }

    private function _add_comi_tipo_comision(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (NEW _instalacion($link))->create_table_new(table:'comi_tipo_comision');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al crear comi_tipo_comision', data: $create);
        }

        $out->create = $create;

        return $out;
    }


    final public function instala(PDO $link): array|stdClass
    {

        $out = new stdClass();



        return $out;

    }

}
