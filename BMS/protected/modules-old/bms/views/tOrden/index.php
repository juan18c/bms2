<?php
/* @var $this TOrdenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tordens',
);

$this->menu=array(
	array('label'=>'Create TOrden', 'url'=>array('create')),
	array('label'=>'Manage TOrden', 'url'=>array('admin')),
);
?>

<h1>Tordens</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
