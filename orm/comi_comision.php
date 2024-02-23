<?php
namespace gamboamartin\comisiones\models;

use base\orm\_modelo_parent_sin_codigo;
use gamboamartin\comercial\models\com_agente;
use gamboamartin\comercial\models\com_tipo_agente;
use gamboamartin\errores\errores;
use stdClass;
use PDO;


class comi_comision extends _modelo_parent_sin_codigo {
    public function __construct(PDO $link){
        $tabla = 'comi_comision';
        $columnas = array($tabla=>false, 'com_agente' => $tabla, 'fc_factura' => $tabla,
            'comi_conf_comision' => $tabla, 'comi_tipo_comision' => 'comi_conf_comision');
        $campos_obligatorios = array();

        $no_duplicados = array();


        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas,no_duplicados: $no_duplicados);

        $this->NAMESPACE = __NAMESPACE__;
    }

    public function alta_bd(array $keys_integra_ds = array('codigo', 'descripcion')): array|stdClass
    {
        $r_agente = (new com_agente(link: $this->link))->registro($this->registro['com_agente_id']);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al insertar com tipo agente', data: $r_agente);
        }

        $r_conf_comision = (new comi_conf_comision(link: $this->link))->registro(
            $this->registro['comi_conf_comision_id']);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al insertar conf_comision', data: $r_conf_comision);
        }


        if(!isset($this->registro['codigo'])){
            $this->registro['codigo'] = $r_agente['com_agente_descripcion']." - ".
                $r_conf_comision['comi_conf_comision_descripcion']." - ".rand();
        }

        if(!isset($this->registro['descripcion'])){
            $this->registro['descripcion'] = $r_agente['com_agente_descripcion']." - ".rand();
        }

        if(!isset($this->registro['descripcion_select'])){
            $this->registro['descripcion_select'] = $r_agente['com_agente_descripcion']." - ".
                $this->registro['monto_pago']." - ".$this->registro['fecha_pago'];
        }

        $r_alta_bd = parent::alta_bd($keys_integra_ds);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al insertar solicitud etapa', data: $r_alta_bd);
        }

        return $r_alta_bd;
    }

    public function aplica_conf(int $comi_conf_comision_id, string $fecha_comision){

        $filtro_fecha['campo_1'] = 'fecha_inicial';
        $filtro_fecha['campo_2'] = 'fecha_final';
        $filtro_fecha['fecha'] = $fecha_comision;

        $filtro['comi_conf_comision.id'] = $comi_conf_comision_id;

        $r_conf_comision = (new comi_conf_comision(link: $this->link))->filtro_and(filtro: $filtro,
            filtro_fecha: $filtro_fecha);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al insertar conf_comision', data: $r_conf_comision);
        }

        if($r_conf_comision->n_registros < 1){
            return $this->error->error(mensaje: 'Error no existe configuracion comision', data: $r_conf_comision);
        }

        return $r_conf_comision;
    }
}