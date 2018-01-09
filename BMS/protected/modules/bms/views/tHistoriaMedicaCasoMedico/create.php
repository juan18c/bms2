<?php
/* @var $this THistoriaMedicaCasoMedicoController */
/* @var $model THistoriaMedicaCasoMedico */

$this->breadcrumbs=array(
	'Thistoria Medica Caso Medicos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List THistoriaMedicaCasoMedico', 'url'=>array('index')),
	array('label'=>'Manage THistoriaMedicaCasoMedico', 'url'=>array('admin')),
);
?>

<h1>Create THistoriaMedicaCasoMedico</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>