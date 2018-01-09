<?php
/* @var $this TMedicoController */
/* @var $model TMedico */

$this->breadcrumbs=array(
	'Tmedicos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TMedico', 'url'=>array('index')),
	array('label'=>'Manage TMedico', 'url'=>array('admin')),
);
?>

<h1>Create TMedico</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>