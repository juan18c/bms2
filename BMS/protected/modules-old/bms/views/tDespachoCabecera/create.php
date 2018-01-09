<?php
/* @var $this TDespachoCabeceraController */
/* @var $model TDespachoCabecera */

$this->breadcrumbs=array(
	'Tdespacho Cabeceras'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TDespachoCabecera', 'url'=>array('index')),
	array('label'=>'Manage TDespachoCabecera', 'url'=>array('admin')),
);
?>

<h1>Create TDespachoCabecera</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>