<?php
/* @var $this TCreditoDonacionController */
/* @var $model TCreditoDonacion */

$this->breadcrumbs=array(
	'Tcredito Donacions'=>array('index'),
	$model->id_credito_donacion,
);

$this->menu=array(
	array('label'=>'List TCreditoDonacion', 'url'=>array('index')),
	array('label'=>'Create TCreditoDonacion', 'url'=>array('create')),
	array('label'=>'Update TCreditoDonacion', 'url'=>array('update', 'id'=>$model->id_credito_donacion)),
	array('label'=>'Delete TCreditoDonacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_credito_donacion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TCreditoDonacion', 'url'=>array('admin')),
);
?>

<h1>View TCreditoDonacion #<?php echo $model->id_credito_donacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_credito_donacion',
		'id_donacion',
		'monto_disponible',
		'id_usuario',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
