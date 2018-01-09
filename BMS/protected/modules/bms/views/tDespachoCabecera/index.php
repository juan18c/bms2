<?php
/* @var $this TDespachoCabeceraController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tdespacho Cabeceras',
);

$this->menu=array(
	array('label'=>'Create TDespachoCabecera', 'url'=>array('create')),
	array('label'=>'Manage TDespachoCabecera', 'url'=>array('admin')),
);
?>

<h1>Tdespacho Cabeceras</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
