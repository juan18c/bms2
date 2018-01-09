<?php
/* @var $this THistoriaMedicaCasoController */
/* @var $model THistoriaMedicaCaso */

$this->breadcrumbs=array(
	'Thistoria Medica Casos'=>array('index'),
	$model->id_historia_medica_caso=>array('view','id'=>$model->id_historia_medica_caso),
	'Update',
);

$this->menu=array(
	array('label'=>'List THistoriaMedicaCaso', 'url'=>array('index')),
	array('label'=>'Create THistoriaMedicaCaso', 'url'=>array('create')),
	array('label'=>'View THistoriaMedicaCaso', 'url'=>array('view', 'id'=>$model->id_historia_medica_caso)),
	array('label'=>'Manage THistoriaMedicaCaso', 'url'=>array('admin')),
);
?>

<h1>Update THistoriaMedicaCaso <?php echo $model->id_historia_medica_caso; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>