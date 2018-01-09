<?php
/* @var $this TProductoCategoriaController */
/* @var $model TProductoCategoria */

$this->breadcrumbs=array(
	'Tproducto Categorias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TProductoCategoria', 'url'=>array('index')),
	array('label'=>'Manage TProductoCategoria', 'url'=>array('admin')),
);
?>

<h1>Create TProductoCategoria</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>