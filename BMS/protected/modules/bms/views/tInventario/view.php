<?php
/* @var $this TInventarioController */
/* @var $model TInventario */

$this->breadcrumbs=array(
	'Tinventarios'=>array('index'),
	$model->id_inventario,
);

$this->menu=array(
	array('label'=>'List TInventario', 'url'=>array('index')),
	array('label'=>'Create TInventario', 'url'=>array('create')),
	array('label'=>'Update TInventario', 'url'=>array('update', 'id'=>$model->id_inventario)),
	array('label'=>'Delete TInventario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_inventario),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TInventario', 'url'=>array('admin')),
);
?>

<h1>View TInventario #<?php echo $model->id_inventario; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_inventario',
		'id_producto',
		'cantidad',
		'stock_minimo',
		'stock_maximo',
		'fecha_compra',
		'fecha_vencimiento',
		'precio',
		'id_almacen',
		'tipo_almacenamiento',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
