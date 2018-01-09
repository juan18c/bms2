<?php
/* @var $this TCotizacionController */
/* @var $model TCotizacion */

$this->breadcrumbs=array(
	'Tcotizacions'=>array('index'),
	$model->id_cotizacion,
);

$this->menu=array(
	array('label'=>'List TCotizacion', 'url'=>array('index')),
	array('label'=>'Create TCotizacion', 'url'=>array('create')),
	array('label'=>'Update TCotizacion', 'url'=>array('update', 'id'=>$model->id_cotizacion)),
	array('label'=>'Delete TCotizacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_cotizacion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TCotizacion', 'url'=>array('admin')),
);
?>

<h1>View TCotizacion #<?php echo $model->id_cotizacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_cotizacion',
		'id_carrito',
		'id_responsable',
		'id_medico_responsable',
		'duracion',
		'frecuencia',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
