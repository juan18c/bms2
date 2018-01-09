<?php
/* @var $this THistoriaMedicaCasoController */
/* @var $model THistoriaMedicaCaso */

$this->breadcrumbs=array(
	'Thistoria Medica Casos'=>array('index'),
	$model->id_historia_medica_caso,
);

$this->menu=array(
	array('label'=>'List THistoriaMedicaCaso', 'url'=>array('index')),
	array('label'=>'Create THistoriaMedicaCaso', 'url'=>array('create')),
	array('label'=>'Update THistoriaMedicaCaso', 'url'=>array('update', 'id'=>$model->id_historia_medica_caso)),
	array('label'=>'Delete THistoriaMedicaCaso', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_historia_medica_caso),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage THistoriaMedicaCaso', 'url'=>array('admin')),
);
?>

<h1>View THistoriaMedicaCaso #<?php echo $model->id_historia_medica_caso; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_historia_medica_caso',
		'id_historia_medica',
		'nombre',
		'tipo_carga',
		'duracion',
		'frecuencia',
		'id_cotizacion',
		'fecha_realizacion',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
