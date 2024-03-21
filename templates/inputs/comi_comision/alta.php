<?php /** @var  \gamboamartin\facturacion\controllers\controlador_fc_factura $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>
<?php echo $controlador->inputs->fc_factura_id; ?>
<?php echo $controlador->inputs->com_agente_id; ?>
<?php echo $controlador->inputs->comi_conf_comision_id; ?>
<?php echo $controlador->inputs->cat_sat_periodo_id; ?>
<?php echo $controlador->inputs->monto_pago; ?>
<?php echo $controlador->inputs->fecha_pago; ?>

<?php include (new views())->ruta_templates.'botons/submit/alta_bd.php';?>