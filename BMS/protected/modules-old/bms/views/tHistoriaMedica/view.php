<?php
/* @var $this THistoriaMedicaController */
/* @var $model THistoriaMedica */

$this->breadcrumbs=array(
	'Thistoria Medicas'=>array('index'),
	$model->id_historia_medica,
);

$this->menu=array(
	array('label'=>'List THistoriaMedica', 'url'=>array('index')),
	array('label'=>'Create THistoriaMedica', 'url'=>array('create')),
	array('label'=>'Update THistoriaMedica', 'url'=>array('update', 'id'=>$model->id_historia_medica)),
	array('label'=>'Delete THistoriaMedica', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_historia_medica),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage THistoriaMedica', 'url'=>array('admin')),
);
?>

<h1>View THistoriaMedica #<?php echo $model->id_historia_medica; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_historia_medica',
		'id_responsable',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
