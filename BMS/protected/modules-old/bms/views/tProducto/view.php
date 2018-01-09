<?php
/* @var $this TProductoController */
/* @var $model TProducto */

$this->breadcrumbs=array(
	'Tproductos'=>array('index'),
	$model->id_producto,
);

$this->menu=array(
	array('label'=>'List TProducto', 'url'=>array('index')),
	array('label'=>'Create TProducto', 'url'=>array('create')),
	array('label'=>'Update TProducto', 'url'=>array('update', 'id'=>$model->id_producto)),
	array('label'=>'Delete TProducto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_producto),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TProducto', 'url'=>array('admin')),
);
?>

<h1>View TProducto #<?php echo $model->id_producto; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_producto',
		'codigo',
		'descripcion',
		'id_producto_tipo',
		'id_producto_categoria',
		'id_marca',
		'foto_principal',
		'foto_detalle',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
