<?php
/* @var $this TBeneficiarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tbeneficiarios',
);

$this->menu=array(
	array('label'=>'Create TBeneficiario', 'url'=>array('create')),
	array('label'=>'Manage TBeneficiario', 'url'=>array('admin')),
);
?>

<h1>Tbeneficiarios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
