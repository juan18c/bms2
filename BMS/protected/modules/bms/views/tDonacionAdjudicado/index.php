<?php
/* @var $this TDonacionAdjudicadoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tdonacion Adjudicados',
);

$this->menu=array(
	array('label'=>'Create TDonacionAdjudicado', 'url'=>array('create')),
	array('label'=>'Manage TDonacionAdjudicado', 'url'=>array('admin')),
);
?>

<h1>Tdonacion Adjudicados</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
