<?php
/* @var $this TDonacionMovimientoController */
/* @var $model TDonacionMovimiento */

$this->breadcrumbs=array(
	'Tdonacion Movimientos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TDonacionMovimiento', 'url'=>array('index')),
	array('label'=>'Manage TDonacionMovimiento', 'url'=>array('admin')),
);
?>

<h1>Create TDonacionMovimiento</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>