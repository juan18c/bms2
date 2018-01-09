<?php
/* @var $this THistoriaMedicaController */
/* @var $model THistoriaMedica */

$this->breadcrumbs=array(
	'Thistoria Medicas'=>array('index'),
	$model->id_historia_medica=>array('view','id'=>$model->id_historia_medica),
	'Update',
);

$this->menu=array(
	array('label'=>'List THistoriaMedica', 'url'=>array('index')),
	array('label'=>'Create THistoriaMedica', 'url'=>array('create')),
	array('label'=>'View THistoriaMedica', 'url'=>array('view', 'id'=>$model->id_historia_medica)),
	array('label'=>'Manage THistoriaMedica', 'url'=>array('admin')),
);
?>

<h1>Update THistoriaMedica <?php echo $model->id_historia_medica; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>