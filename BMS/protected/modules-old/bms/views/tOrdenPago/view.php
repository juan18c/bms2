<?php
/* @var $this TOrdenPagoController */
/* @var $model TOrdenPago */

$this->breadcrumbs=array(
	'Torden Pagos'=>array('index'),
	$model->id_orden_pago,
);

$this->menu=array(
	array('label'=>'List TOrdenPago', 'url'=>array('index')),
	array('label'=>'Create TOrdenPago', 'url'=>array('create')),
	array('label'=>'Update TOrdenPago', 'url'=>array('update', 'id'=>$model->id_orden_pago)),
	array('label'=>'Delete TOrdenPago', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_orden_pago),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TOrdenPago', 'url'=>array('admin')),
);
?>

<h1>View TOrdenPago #<?php echo $model->id_orden_pago; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_orden_pago',
		'id_orden',
		'nombre_banco',
		'numero_cuenta',
		'numero_ruta_bancaria',
		'nombre_tarjeta',
		'numero_tarjeta',
		'tipo_tarjeta',
		'monto',
		'comision',
		'email',
		'id_medio_pago',
		'fecha_pago',
		'comisionPorcentaje',
		'comisionValorFijo',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
