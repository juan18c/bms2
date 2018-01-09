<?php
/* @var $this TCarritoDetalleController */
/* @var $model TCarritoDetalle */

$this->breadcrumbs=array(
	'Tcarrito Detalles'=>array('index'),
	$model->t_carrito_detalle=>array('view','id'=>$model->t_carrito_detalle),
	'Update',
);

$this->menu=array(
	array('label'=>'List TCarritoDetalle', 'url'=>array('index')),
	array('label'=>'Create TCarritoDetalle', 'url'=>array('create')),
	array('label'=>'View TCarritoDetalle', 'url'=>array('view', 'id'=>$model->t_carrito_detalle)),
	array('label'=>'Manage TCarritoDetalle', 'url'=>array('admin')),
);
?>

<h1>Update TCarritoDetalle <?php echo $model->t_carrito_detalle; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>