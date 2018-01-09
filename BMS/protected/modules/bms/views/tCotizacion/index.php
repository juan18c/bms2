<?php
/* @var $this TCotizacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tcotizacions',
);

$this->menu=array(
	array('label'=>'Create TCotizacion', 'url'=>array('create')),
	array('label'=>'Manage TCotizacion', 'url'=>array('admin')),
);
?>

<h1>Tcotizacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
