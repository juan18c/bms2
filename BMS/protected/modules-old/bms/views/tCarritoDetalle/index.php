<?php
/* @var $this TCarritoDetalleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tcarrito Detalles',
);

$this->menu=array(
	array('label'=>'Create TCarritoDetalle', 'url'=>array('create')),
	array('label'=>'Manage TCarritoDetalle', 'url'=>array('admin')),
);
?>

<h1>Tcarrito Detalles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
