<?php
/* @var $this TProductoTipoController */
/* @var $model TProductoTipo */

$this->breadcrumbs=array(
	'Tproducto Tipos'=>array('index'),
	$model->id_producto_tipo,
);

$this->menu=array(
	array('label'=>'List TProductoTipo', 'url'=>array('index')),
	array('label'=>'Create TProductoTipo', 'url'=>array('create')),
	array('label'=>'Update TProductoTipo', 'url'=>array('update', 'id'=>$model->id_producto_tipo)),
	array('label'=>'Delete TProductoTipo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_producto_tipo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TProductoTipo', 'url'=>array('admin')),
);
?>

<h1>View TProductoTipo #<?php echo $model->id_producto_tipo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_producto_tipo',
		'descripcion',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
