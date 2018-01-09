<?php
/* @var $this TAlmacenController */
/* @var $model TAlmacen */

$this->breadcrumbs=array(
	'Talmacens'=>array('index'),
	$model->id_almacen=>array('view','id'=>$model->id_almacen),
	'Update',
);

$this->menu=array(
	array('label'=>'List TAlmacen', 'url'=>array('index')),
	array('label'=>'Create TAlmacen', 'url'=>array('create')),
	array('label'=>'View TAlmacen', 'url'=>array('view', 'id'=>$model->id_almacen)),
	array('label'=>'Manage TAlmacen', 'url'=>array('admin')),
);
?>

<h1>Update TAlmacen <?php echo $model->id_almacen; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>