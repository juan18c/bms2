<?php
/* @var $this TInventarioController */
/* @var $model TInventario */

$this->breadcrumbs=array(
	'Tinventarios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TInventario', 'url'=>array('index')),
	array('label'=>'Manage TInventario', 'url'=>array('admin')),
);
?>

<h1>Create TInventario</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>