<?php
/* @var $this TProductoController */
/* @var $model TProducto */

$this->breadcrumbs=array(
	'Tproductos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TProducto', 'url'=>array('index')),
	array('label'=>'Manage TProducto', 'url'=>array('admin')),
);
?>

<h1>Create TProducto</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'modelInventario'=>$modelInventario)); ?>