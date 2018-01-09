<?php
/* @var $this TRolController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Trols',
);

$this->menu=array(
	array('label'=>'Create TRol', 'url'=>array('create')),
	array('label'=>'Manage TRol', 'url'=>array('admin')),
);
?>

<h1>Trols</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
