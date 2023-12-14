<?php
namespace controllers;


use gamboamartin\errores\errores;

use gamboamartin\gastos\controllers\controlador_gt_tipo_solicitud;
use gamboamartin\test\liberator;
use gamboamartin\test\test;
use html\fc_csd_html;

use stdClass;


class controlador_comi_tipo_comisionTest extends test {
    public errores $errores;
    private stdClass $paths_conf;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
        $this->paths_conf = new stdClass();
        $this->paths_conf->generales = '/var/www/html/comision/config/generales.php';
        $this->paths_conf->database = '/var/www/html/comision/config/database.php';
        $this->paths_conf->views = '/var/www/html/comision/config/views.php';
    }


}

