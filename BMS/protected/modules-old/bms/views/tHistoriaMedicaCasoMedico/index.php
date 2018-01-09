<?php
/* @var $this THistoriaMedicaCasoMedicoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Thistoria Medica Caso Medicos',
);

$this->menu=array(
	array('label'=>'Create THistoriaMedicaCasoMedico', 'url'=>array('create')),
	array('label'=>'Manage THistoriaMedicaCasoMedico', 'url'=>array('admin')),
);
?>

<h1>Thistoria Medica Caso Medicos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
