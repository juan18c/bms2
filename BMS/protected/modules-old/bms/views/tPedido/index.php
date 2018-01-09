<?php
/* @var $this TPedidoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tpedidos',
);

$this->menu=array(
	array('label'=>'Create TPedido', 'url'=>array('create')),
	array('label'=>'Manage TPedido', 'url'=>array('admin')),
);
?>

<h1>Tpedidos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
