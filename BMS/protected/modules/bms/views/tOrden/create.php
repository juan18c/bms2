<?php
/* @var $this TOrdenController */
/* @var $model TOrden */

$this->breadcrumbs=array(
	'Tordens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TOrden', 'url'=>array('index')),
	array('label'=>'Manage TOrden', 'url'=>array('admin')),
);
?>

<h1>Create TOrden</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>