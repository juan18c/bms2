<?php
/* @var $this THistoriaMedicaCasoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Thistoria Medica Casos',
);

$this->menu=array(
	array('label'=>'Create THistoriaMedicaCaso', 'url'=>array('create')),
	array('label'=>'Manage THistoriaMedicaCaso', 'url'=>array('admin')),
);
?>

<h1>Thistoria Medica Casos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
