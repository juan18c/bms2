<?php
/* @var $this TDonacionMovimientoController */
/* @var $model TDonacionMovimiento */

$this->breadcrumbs=array(
	'Tdonacion Movimientos'=>array('index'),
	$model->id_donacion_movimiento=>array('view','id'=>$model->id_donacion_movimiento),
	'Update',
);

$this->menu=array(
	array('label'=>'List TDonacionMovimiento', 'url'=>array('index')),
	array('label'=>'Create TDonacionMovimiento', 'url'=>array('create')),
	array('label'=>'View TDonacionMovimiento', 'url'=>array('view', 'id'=>$model->id_donacion_movimiento)),
	array('label'=>'Manage TDonacionMovimiento', 'url'=>array('admin')),
);
?>

<h1>Update TDonacionMovimiento <?php echo $model->id_donacion_movimiento; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>