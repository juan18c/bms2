<?php
/* @var $this TCotizacionHistoriaMedicaCasoController */
/* @var $model TCotizacionHistoriaMedicaCaso */

$this->breadcrumbs=array(
	'Tcotizacion Historia Medica Casos'=>array('index'),
	$model->id_cotizacion_historia_caso=>array('view','id'=>$model->id_cotizacion_historia_caso),
	'Update',
);

$this->menu=array(
	array('label'=>'List TCotizacionHistoriaMedicaCaso', 'url'=>array('index')),
	array('label'=>'Create TCotizacionHistoriaMedicaCaso', 'url'=>array('create')),
	array('label'=>'View TCotizacionHistoriaMedicaCaso', 'url'=>array('view', 'id'=>$model->id_cotizacion_historia_caso)),
	array('label'=>'Manage TCotizacionHistoriaMedicaCaso', 'url'=>array('admin')),
);
?>

<h1>Update TCotizacionHistoriaMedicaCaso <?php echo $model->id_cotizacion_historia_caso; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>