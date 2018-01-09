<?php
/* @var $this TAlmacenController */
/* @var $model TAlmacen */

$this->breadcrumbs=array(
	'Talmacens'=>array('index'),
	$model->id_almacen,
);

$this->menu=array(
	array('label'=>'List TAlmacen', 'url'=>array('index')),
	array('label'=>'Create TAlmacen', 'url'=>array('create')),
	array('label'=>'Update TAlmacen', 'url'=>array('update', 'id'=>$model->id_almacen)),
	array('label'=>'Delete TAlmacen', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_almacen),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TAlmacen', 'url'=>array('admin')),
);
?>

<h1>View TAlmacen #<?php echo $model->id_almacen; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_almacen',
		'descripcion',
		'id_pais',
		'id_moneda_base',
		'id_moneda_venta',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
