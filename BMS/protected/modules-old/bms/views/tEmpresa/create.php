<?php
/* @var $this TEmpresaController */
/* @var $model TEmpresa */

$this->breadcrumbs=array(
	'Tempresas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TEmpresa', 'url'=>array('index')),
	array('label'=>'Manage TEmpresa', 'url'=>array('admin')),
);
?>

<h1>Create TEmpresa</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>