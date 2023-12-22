<?php
namespace gamboamartin\comisiones\models;

use base\orm\_modelo_parent_sin_codigo;
use gamboamartin\errores\errores;
use gamboamartin\facturacion\models\fc_factura;
use stdClass;
use PDO;


class comi_rel_comision_factura extends _modelo_parent_sin_codigo {
    public function __construct(PDO $link){
        $tabla = 'comi_rel_comision_factura';
        $columnas = array($tabla=>false);
        $campos_obligatorios = array();

        $no_duplicados = array();


        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas,no_duplicados: $no_duplicados);

        $this->NAMESPACE = __NAMESPACE__;
    }

    public function alta_bd(array $keys_integra_ds = array('codigo', 'descripcion')): array|stdClass
    {
        $r_comision = (new comi_comision(link: $this->link))->registro($this->registro['comi_comision_id']);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al insertar com tipo comision', data: $r_comision);
        }

        $r_factura = (new fc_factura(link: $this->link))->registro(
            $this->registro['fc_factura_id']);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al insertar factura', data: $r_factura);
        }

        if(!isset($this->registro['codigo'])){
            $this->registro['codigo'] = $r_comision['comi_comision_descripcion']." - ".
                $r_factura['fc_factura_descripcion']." - ".rand();
        }

        if(!isset($this->registro['descripcion'])){
            $this->registro['descripcion'] = $r_comision['comi_comision_descripcion']." - ".rand();
        }

        if(!isset($this->registro['descripcion_select'])){
            $this->registro['descripcion_select'] = $r_comision['comi_comision_descripcion']." - ".
                $r_factura['fc_factura_descripcion'];
        }

        $r_alta_bd = parent::alta_bd($keys_integra_ds);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al insertar solicitud etapa', data: $r_alta_bd);
        }

        return $r_alta_bd;
    }
}