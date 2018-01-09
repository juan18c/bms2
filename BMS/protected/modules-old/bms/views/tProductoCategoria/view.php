<?php
/* @var $this TProductoCategoriaController */
/* @var $model TProductoCategoria */

$this->breadcrumbs=array(
	'Tproducto Categorias'=>array('index'),
	$model->id_producto_categoria,
);

$this->menu=array(
	array('label'=>'List TProductoCategoria', 'url'=>array('index')),
	array('label'=>'Create TProductoCategoria', 'url'=>array('create')),
	array('label'=>'Update TProductoCategoria', 'url'=>array('update', 'id'=>$model->id_producto_categoria)),
	array('label'=>'Delete TProductoCategoria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_producto_categoria),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TProductoCategoria', 'url'=>array('admin')),
);
?>

<h1>View TProductoCategoria #<?php echo $model->id_producto_categoria; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_producto_categoria',
		'descripcion',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
