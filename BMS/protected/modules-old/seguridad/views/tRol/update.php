<?php
/* @var $this TRolController */
/* @var $model TRol */

$this->breadcrumbs=array(
	'Trols'=>array('index'),
	$model->id_rol=>array('view','id'=>$model->id_rol),
	'Update',
);

$this->menu=array(
	array('label'=>'List TRol', 'url'=>array('index')),
	array('label'=>'Create TRol', 'url'=>array('create')),
	array('label'=>'View TRol', 'url'=>array('view', 'id'=>$model->id_rol)),
	array('label'=>'Manage TRol', 'url'=>array('admin')),
);
?>

<h1>Update TRol <?php echo $model->id_rol; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>