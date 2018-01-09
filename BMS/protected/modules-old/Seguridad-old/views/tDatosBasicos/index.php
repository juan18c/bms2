<?php
/* @var $this TDatosBasicosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tdatos Basicoses',
);

$this->menu=array(
	array('label'=>'Create TDatosBasicos', 'url'=>array('create')),
	array('label'=>'Manage TDatosBasicos', 'url'=>array('admin')),
);
?>

<h1>Tdatos Basicoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
