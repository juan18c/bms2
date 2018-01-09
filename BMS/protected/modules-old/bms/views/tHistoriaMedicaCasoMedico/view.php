<?php
/* @var $this THistoriaMedicaCasoMedicoController */
/* @var $model THistoriaMedicaCasoMedico */

$this->breadcrumbs=array(
	'Thistoria Medica Caso Medicos'=>array('index'),
	$model->id_historia_medica_medico,
);

$this->menu=array(
	array('label'=>'List THistoriaMedicaCasoMedico', 'url'=>array('index')),
	array('label'=>'Create THistoriaMedicaCasoMedico', 'url'=>array('create')),
	array('label'=>'Update THistoriaMedicaCasoMedico', 'url'=>array('update', 'id'=>$model->id_historia_medica_medico)),
	array('label'=>'Delete THistoriaMedicaCasoMedico', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_historia_medica_medico),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage THistoriaMedicaCasoMedico', 'url'=>array('admin')),
);
?>

<h1>View THistoriaMedicaCasoMedico #<?php echo $model->id_historia_medica_medico; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_historia_medica_medico',
		'id_historia_medica_caso',
		'id_medico',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
