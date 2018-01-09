<?php
/* @var $this TCotizacionHistoriaMedicaCasoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tcotizacion Historia Medica Casos',
);

$this->menu=array(
	array('label'=>'Create TCotizacionHistoriaMedicaCaso', 'url'=>array('create')),
	array('label'=>'Manage TCotizacionHistoriaMedicaCaso', 'url'=>array('admin')),
);
?>

<h1>Tcotizacion Historia Medica Casos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
