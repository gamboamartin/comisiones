<?php
namespace gamboamartin\comisiones\models;

use base\orm\_modelo_parent_sin_codigo;
use gamboamartin\comercial\models\com_tipo_agente;
use gamboamartin\errores\errores;
use stdClass;
use PDO;


class comi_conf_comision extends _modelo_parent_sin_codigo {
    public function __construct(PDO $link){
        $tabla = 'comi_conf_comision';
        $columnas = array($tabla=>false, 'com_tipo_agente' => $tabla,'comi_tipo_comision' => $tabla,
            'cat_sat_perido' => $tabla);
        $campos_obligatorios = array();

        $no_duplicados = array();


        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas,no_duplicados: $no_duplicados);

        $this->NAMESPACE = __NAMESPACE__;
    }

    public function alta_bd(array $keys_integra_ds = array('codigo', 'descripcion')): array|stdClass
    {
        $r_tipo_agente = (new com_tipo_agente(link: $this->link))->registro($this->registro['com_tipo_agente_id']);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al insertar com tipo agente', data: $r_tipo_agente);
        }

        if(!isset($this->registro['codigo'])){
            $this->registro['codigo'] = $r_tipo_agente['com_tipo_agente_descripcion']." - ".
                $this->registro['monto_pago']." - ".rand();
        }

        if(!isset($this->registro['descripcion'])){
            $this->registro['descripcion'] = $r_tipo_agente['com_tipo_agente_descripcion']." - ".rand();
        }

        if(!isset($this->registro['descripcion_select'])){
            $this->registro['descripcion_select'] = $r_tipo_agente['com_tipo_agente_descripcion']." - ".
                $this->registro['monto_pago'];
        }

        $r_alta_bd = parent::alta_bd($keys_integra_ds);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al insertar solicitud etapa', data: $r_alta_bd);
        }

        return $r_alta_bd;
    }
}