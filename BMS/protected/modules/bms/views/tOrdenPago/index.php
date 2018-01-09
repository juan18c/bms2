<?php
/* @var $this TOrdenPagoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Torden Pagos',
);

$this->menu=array(
	array('label'=>'Create TOrdenPago', 'url'=>array('create')),
	array('label'=>'Manage TOrdenPago', 'url'=>array('admin')),
);
?>

<h1>Torden Pagos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
