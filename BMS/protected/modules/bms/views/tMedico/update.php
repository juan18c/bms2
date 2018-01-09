<?php
/* @var $this TMedicoController */
/* @var $model TMedico */

$this->breadcrumbs=array(
	'Tmedicos'=>array('index'),
	$model->id_medico=>array('view','id'=>$model->id_medico),
	'Update',
);

$this->menu=array(
	array('label'=>'List TMedico', 'url'=>array('index')),
	array('label'=>'Create TMedico', 'url'=>array('create')),
	array('label'=>'View TMedico', 'url'=>array('view', 'id'=>$model->id_medico)),
	array('label'=>'Manage TMedico', 'url'=>array('admin')),
);
?>

<h1>Update TMedico <?php echo $model->id_medico; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>