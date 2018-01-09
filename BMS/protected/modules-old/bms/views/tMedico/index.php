<?php
/* @var $this TMedicoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tmedicos',
);

$this->menu=array(
	array('label'=>'Create TMedico', 'url'=>array('create')),
	array('label'=>'Manage TMedico', 'url'=>array('admin')),
);
?>

<h1>Tmedicos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
