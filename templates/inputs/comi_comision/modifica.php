<?php /** @var  \gamboamartin\comisiones\controllers\controlador_comi_comision $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>
<?php echo $controlador->inputs->fc_factura_id; ?>
<?php echo $controlador->inputs->com_agente_id; ?>
<?php echo $controlador->inputs->comi_conf_comision_id; ?>
<?php echo $controlador->inputs->cat_sat_periodo_id; ?>
<?php echo $controlador->inputs->monto_pago; ?>
<?php echo $controlador->inputs->fecha_pago; ?>
<?php include (new views())->ruta_templates.'botons/submit/modifica_bd.php';?>