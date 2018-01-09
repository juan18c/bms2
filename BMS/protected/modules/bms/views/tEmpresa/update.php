<?php
/* @var $this TEmpresaController */
/* @var $model TEmpresa */

$this->breadcrumbs=array(
	'Tempresas'=>array('index'),
	$model->id_empresa=>array('view','id'=>$model->id_empresa),
	'Update',
);

$this->menu=array(
	array('label'=>'List TEmpresa', 'url'=>array('index')),
	array('label'=>'Create TEmpresa', 'url'=>array('create')),
	array('label'=>'View TEmpresa', 'url'=>array('view', 'id'=>$model->id_empresa)),
	array('label'=>'Manage TEmpresa', 'url'=>array('admin')),
);
?>

<h1>Update TEmpresa <?php echo $model->id_empresa; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>