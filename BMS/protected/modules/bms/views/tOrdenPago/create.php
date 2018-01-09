<?php
/* @var $this TOrdenPagoController */
/* @var $model TOrdenPago */

$this->breadcrumbs=array(
	'Torden Pagos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TOrdenPago', 'url'=>array('index')),
	array('label'=>'Manage TOrdenPago', 'url'=>array('admin')),
);
?>

<h1>Create TOrdenPago</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>