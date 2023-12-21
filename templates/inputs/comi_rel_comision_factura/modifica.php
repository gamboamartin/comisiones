<?php /** @var  \gamboamartin\comisiones\controllers\controlador_comi_conf_comision $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>
<?php echo $controlador->inputs->comi_comision_id; ?>
<?php echo $controlador->inputs->fc_factura_id; ?>
<?php include (new views())->ruta_templates.'botons/submit/modifica_bd.php';?>