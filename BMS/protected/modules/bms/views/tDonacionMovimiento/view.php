<?php
/* @var $this TDonacionMovimientoController */
/* @var $model TDonacionMovimiento */

$this->breadcrumbs=array(
	'Tdonacion Movimientos'=>array('index'),
	$model->id_donacion_movimiento,
);

$this->menu=array(
	array('label'=>'List TDonacionMovimiento', 'url'=>array('index')),
	array('label'=>'Create TDonacionMovimiento', 'url'=>array('create')),
	array('label'=>'Update TDonacionMovimiento', 'url'=>array('update', 'id'=>$model->id_donacion_movimiento)),
	array('label'=>'Delete TDonacionMovimiento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_donacion_movimiento),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TDonacionMovimiento', 'url'=>array('admin')),
);
?>

<h1>View TDonacionMovimiento #<?php echo $model->id_donacion_movimiento; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_donacion_movimiento',
		'id_donacion_adjudicado',
		'id_credito_donacion',
		'monto_credito',
		'monto_debito',
		'id_estatus',
		'id_donacion',
		'id_orden',
		'fecha_creacion',
	),
)); ?>
