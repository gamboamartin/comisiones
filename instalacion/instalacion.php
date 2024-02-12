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
    private stdClass $data;

    public function __construct()
    {
        $data = $this->data();
        if(errores::$error){
            $error = (new errores())->error(mensaje: 'Error al incializar',data:  $data);
            print_r($error);
            exit;
        }

    }

    private function data(): stdClass|array
    {
        $this->data = new stdClass();

        return $this->data;

    }

    final public function instala(PDO $link): array|stdClass
    {

        $out = new stdClass();



        return $out;

    }

}
