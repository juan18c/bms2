<?php
/* @var $this TDespachoDetalleController */
/* @var $model TDespachoDetalle */

$this->breadcrumbs=array(
	'Tdespacho Detalles'=>array('index'),
	$model->id_despacho_detalle,
);

$this->menu=array(
	array('label'=>'List TDespachoDetalle', 'url'=>array('index')),
	array('label'=>'Create TDespachoDetalle', 'url'=>array('create')),
	array('label'=>'Update TDespachoDetalle', 'url'=>array('update', 'id'=>$model->id_despacho_detalle)),
	array('label'=>'Delete TDespachoDetalle', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_despacho_detalle),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TDespachoDetalle', 'url'=>array('admin')),
);
?>

<h1>View TDespachoDetalle #<?php echo $model->id_despacho_detalle; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_despacho_detalle',
		'id_despacho',
		'id_producto',
		'cantidad_solicitada',
		'precio',
		'cantidad_despachada',
		'fecha_despacho',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
