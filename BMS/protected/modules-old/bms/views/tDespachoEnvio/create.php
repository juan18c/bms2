<?php
/* @var $this TDespachoEnvioController */
/* @var $model TDespachoEnvio */

$this->breadcrumbs=array(
	'Tdespacho Envios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TDespachoEnvio', 'url'=>array('index')),
	array('label'=>'Manage TDespachoEnvio', 'url'=>array('admin')),
);
?>

<h1>Create TDespachoEnvio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>