<?php
/* @var $this TDatosBasicosDireccionController */
/* @var $model TDatosBasicosDireccion */

$this->breadcrumbs=array(
	'Tdatos Basicos Direccions'=>array('index'),
	$model->id_datos_basicos_direccion,
);

$this->menu=array(
	array('label'=>'List TDatosBasicosDireccion', 'url'=>array('index')),
	array('label'=>'Create TDatosBasicosDireccion', 'url'=>array('create')),
	array('label'=>'Update TDatosBasicosDireccion', 'url'=>array('update', 'id'=>$model->id_datos_basicos_direccion)),
	array('label'=>'Delete TDatosBasicosDireccion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_datos_basicos_direccion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TDatosBasicosDireccion', 'url'=>array('admin')),
);
?>

<h1>View TDatosBasicosDireccion #<?php echo $model->id_datos_basicos_direccion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_datos_basicos_direccion',
		'id_datos_basicos',
		'direccion1',
		'direccion2',
		'codigo_zip',
		'id_tipo_direccion',
		'id_pais',
		'ciudad',
		'estado',
		'telefono_fijo',
		'indicador_factura',
		'indicador_envio',
		'fecha_creacion',
		'id_estatus',
	),
)); ?>
