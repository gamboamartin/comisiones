<?php
namespace gamboamartin\comisiones\tests\controllers;


use gamboamartin\errores\errores;

use gamboamartin\test\liberator;
use gamboamartin\test\test;

use stdClass;


class controlador_comi_tipo_comisionTest extends test {
    public errores $errores;
    private stdClass $paths_conf;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
        $this->paths_conf = new stdClass();
        $this->paths_conf->generales = '/var/www/html/comisiones/config/generales.php';
        $this->paths_conf->database = '/var/www/html/comisiones/config/database.php';
        $this->paths_conf->views = '/var/www/html/comisiones/config/views.php';
    }


}

