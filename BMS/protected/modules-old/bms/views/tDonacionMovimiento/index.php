<?php
/* @var $this TDonacionMovimientoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tdonacion Movimientos',
);

$this->menu=array(
	array('label'=>'Create TDonacionMovimiento', 'url'=>array('create')),
	array('label'=>'Manage TDonacionMovimiento', 'url'=>array('admin')),
);
?>

<h1>Tdonacion Movimientos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
