<?php
/* @var $this TCarritoDetalleController */
/* @var $model TCarritoDetalle */

$this->breadcrumbs=array(
	'Tcarrito Detalles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TCarritoDetalle', 'url'=>array('index')),
	array('label'=>'Manage TCarritoDetalle', 'url'=>array('admin')),
);
?>

<h1>Create TCarritoDetalle</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>