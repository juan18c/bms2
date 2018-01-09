<?php
/* @var $this TDespachoCabeceraController */
/* @var $model TDespachoCabecera */

$this->breadcrumbs=array(
	'Tdespacho Cabeceras'=>array('index'),
	$model->id_despacho,
);

$this->menu=array(
	array('label'=>'List TDespachoCabecera', 'url'=>array('index')),
	array('label'=>'Create TDespachoCabecera', 'url'=>array('create')),
	array('label'=>'Update TDespachoCabecera', 'url'=>array('update', 'id'=>$model->id_despacho)),
	array('label'=>'Delete TDespachoCabecera', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_despacho),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TDespachoCabecera', 'url'=>array('admin')),
);
?>

<h1>View TDespachoCabecera #<?php echo $model->id_despacho; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_despacho',
		'codigo_despacho',
		'id_orden',
		'items',
		'monto_total',
		'id_tipo_accion',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
