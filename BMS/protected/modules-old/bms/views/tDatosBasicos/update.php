<?php
/* @var $this TDatosBasicosController */
/* @var $model TDatosBasicos */

$this->breadcrumbs=array(
	'Tdatos Basicoses'=>array('index'),
	$model->id_datos_basicos=>array('view','id'=>$model->id_datos_basicos),
	'Update',
);

$this->menu=TUsuario::model()->CargarMenuLateral();

?>

<h1>Update TDatosBasicos <?php echo $model->id_datos_basicos; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>