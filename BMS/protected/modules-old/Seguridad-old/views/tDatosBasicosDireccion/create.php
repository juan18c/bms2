<?php
/* @var $this TDatosBasicosDireccionController */
/* @var $model TDatosBasicosDireccion */

$this->breadcrumbs=array(
	'Tdatos Basicos Direccions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TDatosBasicosDireccion', 'url'=>array('index')),
	array('label'=>'Manage TDatosBasicosDireccion', 'url'=>array('admin')),
);
?>

<h1>Create TDatosBasicosDireccion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>