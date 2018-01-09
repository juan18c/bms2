<?php
/* @var $this TDespachoEnvioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tdespacho Envios',
);

$this->menu=array(
	array('label'=>'Create TDespachoEnvio', 'url'=>array('create')),
	array('label'=>'Manage TDespachoEnvio', 'url'=>array('admin')),
);
?>

<h1>Tdespacho Envios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
