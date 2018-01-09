<?php
/* @var $this TProveedorController */
/* @var $model TProveedor */

$this->breadcrumbs=array(
	'Tproveedors'=>array('index'),
	$model->id_proveedor,
);

$this->menu=array(
	array('label'=>'List TProveedor', 'url'=>array('index')),
	array('label'=>'Create TProveedor', 'url'=>array('create')),
	array('label'=>'Update TProveedor', 'url'=>array('update', 'id'=>$model->id_proveedor)),
	array('label'=>'Delete TProveedor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_proveedor),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TProveedor', 'url'=>array('admin')),
);
?>

<h1>View TProveedor #<?php echo $model->id_proveedor; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_proveedor',
		'id_datos_basicos',
		'id_responsable',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
