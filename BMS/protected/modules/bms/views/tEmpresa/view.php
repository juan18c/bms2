<?php
/* @var $this TEmpresaController */
/* @var $model TEmpresa */

$this->breadcrumbs=array(
	'Tempresas'=>array('index'),
	$model->id_empresa,
);

$this->menu=array(
	array('label'=>'List TEmpresa', 'url'=>array('index')),
	array('label'=>'Create TEmpresa', 'url'=>array('create')),
	array('label'=>'Update TEmpresa', 'url'=>array('update', 'id'=>$model->id_empresa)),
	array('label'=>'Delete TEmpresa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_empresa),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TEmpresa', 'url'=>array('admin')),
);
?>

<h1>View TEmpresa #<?php echo $model->id_empresa; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_empresa',
		'id_responsable',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
