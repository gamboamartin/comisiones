<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace gamboamartin\comisiones\controllers;

use base\controller\controler;
use base\controller\init;
use gamboamartin\comisiones\models\comi_comision;
use gamboamartin\errores\errores;
use gamboamartin\system\_ctl_parent_sin_codigo;
use gamboamartin\system\links_menu;
use gamboamartin\template\html;
use gamboamartin\comisiones\html\comi_comision_html;
use PDO;
use stdClass;

class controlador_comi_comision extends _ctl_parent_sin_codigo {

    public function __construct(PDO      $link, html $html = new \gamboamartin\template_1\html(),
                                stdClass $paths_conf = new stdClass())
    {
        $modelo = new comi_comision(link: $link);
        $html_ = new comi_comision_html(html: $html);
        $obj_link = new links_menu(link: $link, registro_id: $this->registro_id);

        $datatables = $this->init_datatable();
        if (errores::$error) {
            $error = $this->errores->error(mensaje: 'Error al inicializar datatable', data: $datatables);
            print_r($error);
            die('Error');
        }

        parent::__construct(html: $html_, link: $link, modelo: $modelo, obj_link: $obj_link, datatables: $datatables,
            paths_conf: $paths_conf);

        $configuraciones = $this->init_configuraciones();
        if (errores::$error) {
            $error = $this->errores->error(mensaje: 'Error al inicializar configuraciones', data: $configuraciones);
            print_r($error);
            die('Error');
        }

        $this->lista_get_data = true;
    }

    public function alta(bool $header, bool $ws = false): array|string
    {
        $r_alta = $this->init_alta();
        if (errores::$error) {
            return $this->retorno_error(mensaje: 'Error al inicializar alta', data: $r_alta, header: $header, ws: $ws);
        }

        $keys_selects = $this->key_select(cols:6, con_registros: true,filtro:  array(), key: 'cat_sat_periodo_id',
            keys_selects: array(), id_selected: -1, label: 'Periodo');
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }

        $keys_selects = $this->key_select(cols:6, con_registros: true,filtro:  array(), key: 'com_agente_id',
            keys_selects: $keys_selects, id_selected: -1, label: 'Agente');
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }

        $keys_selects = $this->key_select(cols:12, con_registros: true,filtro:  array(), key: 'fc_factura_id',
            keys_selects: $keys_selects, id_selected: -1, label: 'Factura');
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }

        $keys_selects = $this->key_select(cols:6, con_registros: true,filtro:  array(), key: 'comi_conf_comision_id',
            keys_selects: $keys_selects, id_selected: -1, label: 'Conf Comision');
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }

        $keys_selects = $this->key_selects_txt(keys_selects: $keys_selects);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }

        $inputs = $this->inputs(keys_selects: $keys_selects);
        if (errores::$error) {
            return $this->retorno_error(
                mensaje: 'Error al obtener inputs', data: $inputs, header: $header, ws: $ws);
        }

        return $r_alta;
    }

    protected function campos_view(array $inputs = array()): array
    {
        $keys = new stdClass();
        $keys->inputs = array('monto_pago');
        $keys->telefonos = array();
        $keys->fechas = array('fecha_pago');
        $keys->selects = array();

        $init_data = array();
        $init_data['com_agente'] = "gamboamartin\\comercial";
        $init_data['fc_factura'] = "gamboamartin\\facturacion";
        $init_data['comi_conf_comision'] = "gamboamartin\\comisiones";
        $init_data['cat_sat_periodo'] = "gamboamartin\\cat_sat";

        $campos_view = $this->campos_view_base(init_data: $init_data, keys: $keys);
        if (errores::$error) {
            return $this->errores->error(mensaje: 'Error al inicializar campo view', data: $campos_view);
        }

        return $campos_view;
    }

    private function init_configuraciones(): controler
    {
        $this->seccion_titulo = 'Comision';
        $this->titulo_lista = 'Registro de Comision';

        $this->lista_get_data = true;

        return $this;
    }

    protected function init_datatable(): stdClass
    {
        $columns["comi_comision_id"]["titulo"] = "Id";
        $columns["com_agente_descripcion"]["titulo"] = "Agente";
        $columns["comi_comision_monto_pago"]["titulo"] = "Monto";
        $columns["comi_comision_fecha_pago"]["titulo"] = "Fecha";
        $columns["comi_tipo_comision_descripcion"]["titulo"] = "Tipo Comision";

        $filtro = array("comi_comision.id","com_agente.descripcion","comi_comision.monto_pago",
            "comi_comision.fecha_pago","comi_tipo_comision.descripcion");

        $datatables = new stdClass();
        $datatables->columns = $columns;
        $datatables->filtro = $filtro;

        return $datatables;
    }

    protected function key_selects_txt(array $keys_selects): array
    {
        $keys_selects = (new init())->key_select_txt(cols: 6, key: 'monto_pago',
            keys_selects: $keys_selects, place_holder: 'Monto Pago');
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects);
        }

        $keys_selects = (new init())->key_select_txt(cols: 6, key: 'fecha_pago',
            keys_selects: $keys_selects, place_holder: 'Fecha Pago');
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects);
        }

        return $keys_selects;
    }

    public function modifica(bool $header, bool $ws = false, array $keys_selects = array()): array|stdClass
    {
        $r_modifica = $this->init_modifica();
        if (errores::$error) {
            return $this->retorno_error(
                mensaje: 'Error al generar salida de template', data: $r_modifica, header: $header, ws: $ws);
        }

        $keys_selects = $this->key_select(cols:6, con_registros: true,filtro:  array(), key: 'com_agente_id',
            keys_selects: array(), id_selected: $this->row_upd->com_agente_id, label: 'Agente');
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }

        $keys_selects = $this->key_select(cols:12, con_registros: true,filtro:  array(), key: 'fc_factura_id',
            keys_selects: $keys_selects, id_selected: $this->row_upd->fc_factura_id, label: 'Factura');
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }

        $keys_selects = $this->key_select(cols:6, con_registros: true,filtro:  array(), key: 'comi_conf_comision_id',
            keys_selects: $keys_selects, id_selected: $this->row_upd->comi_conf_comision_id, label: 'Conf Comision');
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }

        $base = $this->base_upd(keys_selects: $keys_selects, params: array(), params_ajustados: array());
        if (errores::$error) {
            return $this->retorno_error(mensaje: 'Error al integrar base', data: $base, header: $header, ws: $ws);
        }

        return $r_modifica;
    }



}
