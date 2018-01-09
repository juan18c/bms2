<?php
/* @var $this TRolController */
/* @var $model TRol */

$this->breadcrumbs=array(
	'Trols'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TRol', 'url'=>array('index')),
	array('label'=>'Manage TRol', 'url'=>array('admin')),
);
?>

<h1>Create TRol</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>