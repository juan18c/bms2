<?php
/* @var $this TCotizacionHistoriaMedicaCasoController */
/* @var $model TCotizacionHistoriaMedicaCaso */

$this->breadcrumbs=array(
	'Tcotizacion Historia Medica Casos'=>array('index'),
	$model->id_cotizacion_historia_caso,
);

$this->menu=array(
	array('label'=>'List TCotizacionHistoriaMedicaCaso', 'url'=>array('index')),
	array('label'=>'Create TCotizacionHistoriaMedicaCaso', 'url'=>array('create')),
	array('label'=>'Update TCotizacionHistoriaMedicaCaso', 'url'=>array('update', 'id'=>$model->id_cotizacion_historia_caso)),
	array('label'=>'Delete TCotizacionHistoriaMedicaCaso', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_cotizacion_historia_caso),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TCotizacionHistoriaMedicaCaso', 'url'=>array('admin')),
);
?>

<h1>View TCotizacionHistoriaMedicaCaso #<?php echo $model->id_cotizacion_historia_caso; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_cotizacion_historia_caso',
		'id_cotizacion',
		'id_historia_medica_caso',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
