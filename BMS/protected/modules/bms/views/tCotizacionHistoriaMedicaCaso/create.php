<?php
/* @var $this TCotizacionHistoriaMedicaCasoController */
/* @var $model TCotizacionHistoriaMedicaCaso */

$this->breadcrumbs=array(
	'Tcotizacion Historia Medica Casos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TCotizacionHistoriaMedicaCaso', 'url'=>array('index')),
	array('label'=>'Manage TCotizacionHistoriaMedicaCaso', 'url'=>array('admin')),
);
?>

<h1>Create TCotizacionHistoriaMedicaCaso</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>