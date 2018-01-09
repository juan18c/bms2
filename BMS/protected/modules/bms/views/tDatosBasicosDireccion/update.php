<?php
/* @var $this TDatosBasicosDireccionController */
/* @var $model TDatosBasicosDireccion */

$this->breadcrumbs=array(
	'Tdatos Basicos Direccions'=>array('index'),
	$model->id_datos_basicos_direccion=>array('view','id'=>$model->id_datos_basicos_direccion),
	'Update',
);

$this->menu=array(
	array('label'=>'List TDatosBasicosDireccion', 'url'=>array('index')),
	array('label'=>'Create TDatosBasicosDireccion', 'url'=>array('create')),
	array('label'=>'View TDatosBasicosDireccion', 'url'=>array('view', 'id'=>$model->id_datos_basicos_direccion)),
	array('label'=>'Manage TDatosBasicosDireccion', 'url'=>array('admin')),
);
?>

<h1>Update TDatosBasicosDireccion <?php echo $model->id_datos_basicos_direccion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>