<?php
/* @var $this TCarritoDetalleController */
/* @var $model TCarritoDetalle */

$this->breadcrumbs=array(
	'Tcarrito Detalles'=>array('index'),
	$model->t_carrito_detalle,
);

$this->menu=array(
	array('label'=>'List TCarritoDetalle', 'url'=>array('index')),
	array('label'=>'Create TCarritoDetalle', 'url'=>array('create')),
	array('label'=>'Update TCarritoDetalle', 'url'=>array('update', 'id'=>$model->t_carrito_detalle)),
	array('label'=>'Delete TCarritoDetalle', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->t_carrito_detalle),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TCarritoDetalle', 'url'=>array('admin')),
);
?>

<h1>View TCarritoDetalle #<?php echo $model->t_carrito_detalle; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		't_carrito_detalle',
		'id_carrito',
		'id_producto',
		'cantidad',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
