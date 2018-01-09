<?php
/* @var $this TProductoTipoController */
/* @var $model TProductoTipo */

$this->breadcrumbs=array(
	'Tproducto Tipos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TProductoTipo', 'url'=>array('index')),
	array('label'=>'Manage TProductoTipo', 'url'=>array('admin')),
);
?>

<h1>Create TProductoTipo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>