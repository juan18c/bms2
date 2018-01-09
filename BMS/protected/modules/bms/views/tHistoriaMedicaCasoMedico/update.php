<?php
/* @var $this THistoriaMedicaCasoMedicoController */
/* @var $model THistoriaMedicaCasoMedico */

$this->breadcrumbs=array(
	'Thistoria Medica Caso Medicos'=>array('index'),
	$model->id_historia_medica_medico=>array('view','id'=>$model->id_historia_medica_medico),
	'Update',
);

$this->menu=array(
	array('label'=>'List THistoriaMedicaCasoMedico', 'url'=>array('index')),
	array('label'=>'Create THistoriaMedicaCasoMedico', 'url'=>array('create')),
	array('label'=>'View THistoriaMedicaCasoMedico', 'url'=>array('view', 'id'=>$model->id_historia_medica_medico)),
	array('label'=>'Manage THistoriaMedicaCasoMedico', 'url'=>array('admin')),
);
?>

<h1>Update THistoriaMedicaCasoMedico <?php echo $model->id_historia_medica_medico; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>