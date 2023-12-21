<?php
namespace gamboamartin\comisiones\models;

use base\orm\_modelo_parent_sin_codigo;
use PDO;


class comi_comision extends _modelo_parent_sin_codigo {
    public function __construct(PDO $link){
        $tabla = 'comi_comision';
        $columnas = array($tabla=>false, 'com_agente' => $tabla, 'fc_factura' => $tabla,
            'comi_conf_comision' => $tabla);
        $campos_obligatorios = array();

        $no_duplicados = array();


        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas,no_duplicados: $no_duplicados);

        $this->NAMESPACE = __NAMESPACE__;
    }
}