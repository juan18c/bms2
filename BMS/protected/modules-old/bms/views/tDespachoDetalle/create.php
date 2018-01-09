<?php
/* @var $this TDespachoDetalleController */
/* @var $model TDespachoDetalle */

$this->breadcrumbs=array(
	'Tdespacho Detalles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TDespachoDetalle', 'url'=>array('index')),
	array('label'=>'Manage TDespachoDetalle', 'url'=>array('admin')),
);
?>

<h1>Create TDespachoDetalle</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>