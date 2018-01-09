<?php
/* @var $this TDespachoEnvioController */
/* @var $model TDespachoEnvio */

$this->breadcrumbs=array(
	'Tdespacho Envios'=>array('index'),
	$model->id_despacho_envio,
);

$this->menu=array(
	array('label'=>'List TDespachoEnvio', 'url'=>array('index')),
	array('label'=>'Create TDespachoEnvio', 'url'=>array('create')),
	array('label'=>'Update TDespachoEnvio', 'url'=>array('update', 'id'=>$model->id_despacho_envio)),
	array('label'=>'Delete TDespachoEnvio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_despacho_envio),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TDespachoEnvio', 'url'=>array('admin')),
);
?>

<h1>View TDespachoEnvio #<?php echo $model->id_despacho_envio; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_despacho_envio',
		'id_despacho',
		'id_orden',
		'numero_tracking',
		'courier',
		'items',
		'monto_total',
		'fecha_despacho',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
