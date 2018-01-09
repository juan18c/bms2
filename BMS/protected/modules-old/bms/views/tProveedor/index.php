<?php
/* @var $this TProveedorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tproveedors',
);

$this->menu=array(
	array('label'=>'Create TProveedor', 'url'=>array('create')),
	array('label'=>'Manage TProveedor', 'url'=>array('admin')),
);
?>

<h1>Tproveedors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
