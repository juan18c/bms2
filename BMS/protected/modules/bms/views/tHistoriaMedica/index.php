<?php
/* @var $this THistoriaMedicaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Thistoria Medicas',
);

$this->menu=array(
	array('label'=>'Create THistoriaMedica', 'url'=>array('create')),
	array('label'=>'Manage THistoriaMedica', 'url'=>array('admin')),
);
?>

<h1>Thistoria Medicas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
