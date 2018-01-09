<?php
/* @var $this TInventarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tinventarios',
);

$this->menu=array(
	array('label'=>'Create TInventario', 'url'=>array('create')),
	array('label'=>'Manage TInventario', 'url'=>array('admin')),
);
?>

<h1>Tinventarios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
