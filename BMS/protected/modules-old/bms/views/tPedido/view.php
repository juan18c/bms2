<?php
/* @var $this TPedidoController */
/* @var $model TPedido */

$this->breadcrumbs=array(
	'Tpedidos'=>array('index'),
	$model->id_pedido,
);

$this->menu=array(
	array('label'=>'List TPedido', 'url'=>array('index')),
	array('label'=>'Create TPedido', 'url'=>array('create')),
	array('label'=>'Update TPedido', 'url'=>array('update', 'id'=>$model->id_pedido)),
	array('label'=>'Delete TPedido', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_pedido),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TPedido', 'url'=>array('admin')),
);
?>

<h1>View TPedido #<?php echo $model->id_pedido; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_pedido',
		'id_carrito',
		'id_medio_pago',
		'monto_total',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
