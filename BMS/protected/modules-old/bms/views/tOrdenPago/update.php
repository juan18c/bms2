<?php
/* @var $this TOrdenPagoController */
/* @var $model TOrdenPago */

$this->breadcrumbs=array(
	'Torden Pagos'=>array('index'),
	$model->id_orden_pago=>array('view','id'=>$model->id_orden_pago),
	'Update',
);

$this->menu=array(
	array('label'=>'List TOrdenPago', 'url'=>array('index')),
	array('label'=>'Create TOrdenPago', 'url'=>array('create')),
	array('label'=>'View TOrdenPago', 'url'=>array('view', 'id'=>$model->id_orden_pago)),
	array('label'=>'Manage TOrdenPago', 'url'=>array('admin')),
);
?>

<h1>Update TOrdenPago <?php echo $model->id_orden_pago; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>