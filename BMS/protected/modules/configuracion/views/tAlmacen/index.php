<?php
/* @var $this TAlmacenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Talmacens',
);

$this->menu=array(
	array('label'=>'Create TAlmacen', 'url'=>array('create')),
	array('label'=>'Manage TAlmacen', 'url'=>array('admin')),
);
?>

<h1>Talmacens</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
