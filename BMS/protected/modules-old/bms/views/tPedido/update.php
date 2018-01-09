<?php
/* @var $this TPedidoController */
/* @var $model TPedido */

$this->breadcrumbs=array(
	'Tpedidos'=>array('index'),
	$model->id_pedido=>array('view','id'=>$model->id_pedido),
	'Update',
);

$this->menu=array(
	array('label'=>'List TPedido', 'url'=>array('index')),
	array('label'=>'Create TPedido', 'url'=>array('create')),
	array('label'=>'View TPedido', 'url'=>array('view', 'id'=>$model->id_pedido)),
	array('label'=>'Manage TPedido', 'url'=>array('admin')),
);
?>

<h1>Update TPedido <?php echo $model->id_pedido; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>