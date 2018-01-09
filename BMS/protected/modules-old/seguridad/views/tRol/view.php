<?php
/* @var $this TRolController */
/* @var $model TRol */

$this->breadcrumbs=array(
	'Trols'=>array('index'),
	$model->id_rol,
);

$this->menu=array(
	array('label'=>'List TRol', 'url'=>array('index')),
	array('label'=>'Create TRol', 'url'=>array('create')),
	array('label'=>'Update TRol', 'url'=>array('update', 'id'=>$model->id_rol)),
	array('label'=>'Delete TRol', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_rol),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TRol', 'url'=>array('admin')),
);
?>

<h1>View TRol #<?php echo $model->id_rol; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_rol',
		'nombre_rol',
		'descripcion',
		'multi_ip',
		'multi_sesion',
		'fecha_creacion',
		'id_estatus',
	),
)); ?>
