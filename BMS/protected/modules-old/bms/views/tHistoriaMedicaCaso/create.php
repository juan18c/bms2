<?php
/* @var $this THistoriaMedicaCasoController */
/* @var $model THistoriaMedicaCaso */

$this->breadcrumbs=array(
	'Thistoria Medica Casos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List THistoriaMedicaCaso', 'url'=>array('index')),
	array('label'=>'Manage THistoriaMedicaCaso', 'url'=>array('admin')),
);
?>

<h1>Create THistoriaMedicaCaso</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>