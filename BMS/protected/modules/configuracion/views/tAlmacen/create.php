<?php
/* @var $this TAlmacenController */
/* @var $model TAlmacen */

$this->breadcrumbs=array(
	'Talmacens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TAlmacen', 'url'=>array('index')),
	array('label'=>'Manage TAlmacen', 'url'=>array('admin')),
);
?>

<h1>Create TAlmacen</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>