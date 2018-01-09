<?php
/* @var $this TCreditoDonacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tcredito Donacions',
);

$this->menu=array(
	array('label'=>'Create TCreditoDonacion', 'url'=>array('create')),
	array('label'=>'Manage TCreditoDonacion', 'url'=>array('admin')),
);
?>

<h1>Tcredito Donacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
