<?php
/* @var $this TInventarioController */
/* @var $model TInventario */

$this->breadcrumbs=array(
	'Tinventarios'=>array('index'),
	$model->id_inventario=>array('view','id'=>$model->id_inventario),
	'Update',
);

$this->menu=array(
	array('label'=>'List TInventario', 'url'=>array('index')),
	array('label'=>'Create TInventario', 'url'=>array('create')),
	array('label'=>'View TInventario', 'url'=>array('view', 'id'=>$model->id_inventario)),
	array('label'=>'Manage TInventario', 'url'=>array('admin')),
);
?>

<h1>Update TInventario <?php echo $model->id_inventario; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>