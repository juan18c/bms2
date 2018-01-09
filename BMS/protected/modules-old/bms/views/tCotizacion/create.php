<?php
/* @var $this TCotizacionController */
/* @var $model TCotizacion */

$this->breadcrumbs=array(
	'Tcotizacions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TCotizacion', 'url'=>array('index')),
	array('label'=>'Manage TCotizacion', 'url'=>array('admin')),
);
?>

<h1>Create TCotizacion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>