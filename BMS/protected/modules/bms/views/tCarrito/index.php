<?php
/* @var $this TCarritoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tcarritos',
);

$this->menu=array(
	array('label'=>'Create TCarrito', 'url'=>array('create')),
	array('label'=>'Manage TCarrito', 'url'=>array('admin')),
);
?>

<h1>Tcarritos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
