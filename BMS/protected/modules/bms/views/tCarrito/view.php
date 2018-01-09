<?php
/* @var $this TCarritoController */
/* @var $model TCarrito */

$this->breadcrumbs=array(
	'Tcarritos'=>array('index'),
	$model->id_carrito,
);

$this->menu=array(
	array('label'=>'List TCarrito', 'url'=>array('index')),
	array('label'=>'Create TCarrito', 'url'=>array('create')),
	array('label'=>'Update TCarrito', 'url'=>array('update', 'id'=>$model->id_carrito)),
	array('label'=>'Delete TCarrito', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_carrito),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TCarrito', 'url'=>array('admin')),
);
?>

<h1>View TCarrito #<?php echo $model->id_carrito; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_carrito',
		'id_datos_basicos',
		'id_tipo_accion',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
