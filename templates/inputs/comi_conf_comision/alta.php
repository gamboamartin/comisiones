<?php /** @var  \gamboamartin\facturacion\controllers\controlador_fc_factura $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>
<?php echo $controlador->inputs->fecha_inicial; ?>
<?php echo $controlador->inputs->fecha_final; ?>
<?php echo $controlador->inputs->monto_pago; ?>
<?php echo $controlador->inputs->com_tipo_agente_id; ?>
<?php include (new views())->ruta_templates.'botons/submit/alta_bd.php';?>