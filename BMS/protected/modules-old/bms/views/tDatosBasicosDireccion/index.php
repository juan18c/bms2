<?php
/* @var $this TDatosBasicosDireccionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tdatos Basicos Direccions',
);

$this->menu=array(
	array('label'=>'Create TDatosBasicosDireccion', 'url'=>array('create')),
	array('label'=>'Manage TDatosBasicosDireccion', 'url'=>array('admin')),
);
?>

<h1>Tdatos Basicos Direccions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
