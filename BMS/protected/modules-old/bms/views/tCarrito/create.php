<?php
/* @var $this TCarritoController */
/* @var $model TCarrito */

$this->breadcrumbs=array(
	'Tcarritos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TCarrito', 'url'=>array('index')),
	array('label'=>'Manage TCarrito', 'url'=>array('admin')),
);
?>

<h1>Create TCarrito</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>