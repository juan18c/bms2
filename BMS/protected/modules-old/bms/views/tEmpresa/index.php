<?php
/* @var $this TEmpresaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tempresas',
);

$this->menu=array(
	array('label'=>'Create TEmpresa', 'url'=>array('create')),
	array('label'=>'Manage TEmpresa', 'url'=>array('admin')),
);
?>

<h1>Tempresas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
