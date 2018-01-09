<?php
/* @var $this TPedidoController */
/* @var $model TPedido */

$this->breadcrumbs=array(
	'Tpedidos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TPedido', 'url'=>array('index')),
	array('label'=>'Manage TPedido', 'url'=>array('admin')),
);
?>

<h1>Create TPedido</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>