<?php
/* @var $this TCreditoDonacionController */
/* @var $model TCreditoDonacion */

$this->breadcrumbs=array(
	'Tcredito Donacions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TCreditoDonacion', 'url'=>array('index')),
	array('label'=>'Manage TCreditoDonacion', 'url'=>array('admin')),
);
?>

<h1>Create TCreditoDonacion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>