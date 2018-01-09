<?php
/* @var $this TDespachoDetalleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tdespacho Detalles',
);

$this->menu=array(
	array('label'=>'Create TDespachoDetalle', 'url'=>array('create')),
	array('label'=>'Manage TDespachoDetalle', 'url'=>array('admin')),
);
?>

<h1>Tdespacho Detalles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
