<?php
/* @var $this TTipoAccionController */
/* @var $model TTipoAccion */

$this->breadcrumbs=array(
	'Ttipo Accions'=>array('index'),
	$model->id_tipo_accion,
);

$this->menu=array(
	array('label'=>'List TTipoAccion', 'url'=>array('index')),
	array('label'=>'Create TTipoAccion', 'url'=>array('create')),
	array('label'=>'Update TTipoAccion', 'url'=>array('update', 'id'=>$model->id_tipo_accion)),
	array('label'=>'Delete TTipoAccion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_tipo_accion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TTipoAccion', 'url'=>array('admin')),
);
?>

<h1>View TTipoAccion #<?php echo $model->id_tipo_accion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_tipo_accion',
		'descripcion',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
