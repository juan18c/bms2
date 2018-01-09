<?php
/* @var $this TDonacionController */
/* @var $model TDonacion */

$this->breadcrumbs=array(
	'Tdonacions'=>array('index'),
	$model->id_donacion,
);

$this->menu=array(
	array('label'=>'List TDonacion', 'url'=>array('index')),
	array('label'=>'Create TDonacion', 'url'=>array('create')),
	array('label'=>'Update TDonacion', 'url'=>array('update', 'id'=>$model->id_donacion)),
	array('label'=>'Delete TDonacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_donacion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TDonacion', 'url'=>array('admin')),
);
?>

<h1>View TDonacion #<?php echo $model->id_donacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_donacion',
		'codigo_donacion',
		'id_cotizacion',
		'monto_acumulado',
		'diagnostico',
		'sintomas',
		'resumen',
		'objetivo',
		'foto',
		'video',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
