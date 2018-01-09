<?php
/* @var $this TProveedorController */
/* @var $model TProveedor */

$this->breadcrumbs=array(
	'Tproveedors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TProveedor', 'url'=>array('index')),
	array('label'=>'Manage TProveedor', 'url'=>array('admin')),
);
?>

<h1>Create TProveedor</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>