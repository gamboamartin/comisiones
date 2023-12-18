<?php
namespace gamboamartin\comisiones\html;

use gamboamartin\comisiones\models\comi_conf_comision;
use gamboamartin\comisiones\models\comi_rel_comision_factura;
use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use gamboamartin\template\directivas;
use PDO;

class comi_rel_comision_factura_html extends html_controler {

    public function select_comi_rel_comision_factura_id(int $cols, bool $con_registros, int|null $id_selected, PDO $link,
                                                bool $disabled = false, array $filtro = array(),
                                                bool $required = false): array|string
    {
        $valida = (new directivas(html:$this->html_base))->valida_cols(cols:$cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar cols', data: $valida);
        }
        if(is_null($id_selected)){
            $id_selected = -1;
        }
        $modelo = new comi_rel_comision_factura($link);

        $select = $this->select_catalogo(cols: $cols, con_registros: $con_registros, id_selected: $id_selected,
            modelo: $modelo, disabled: $disabled, filtro: $filtro, label: 'Tipo Solicitud',
            name: 'gt_tipo_solicitud_id', required: $required);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }
}
