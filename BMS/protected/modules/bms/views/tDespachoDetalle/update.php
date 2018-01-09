<?php
/* @var $this TDespachoDetalleController */
/* @var $model TDespachoDetalle */

$this->breadcrumbs=array(
	'Tdespacho Detalles'=>array('index'),
	$model->id_despacho_detalle=>array('view','id'=>$model->id_despacho_detalle),
	'Update',
);

$this->menu=array(
	array('label'=>'List TDespachoDetalle', 'url'=>array('index')),
	array('label'=>'Create TDespachoDetalle', 'url'=>array('create')),
	array('label'=>'View TDespachoDetalle', 'url'=>array('view', 'id'=>$model->id_despacho_detalle)),
	array('label'=>'Manage TDespachoDetalle', 'url'=>array('admin')),
);
?>

<h1>Update TDespachoDetalle <?php echo $model->id_despacho_detalle; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>