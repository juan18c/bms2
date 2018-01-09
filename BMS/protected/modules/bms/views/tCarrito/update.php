<?php
/* @var $this TCarritoController */
/* @var $model TCarrito */

$this->breadcrumbs=array(
	'Tcarritos'=>array('index'),
	$model->id_carrito=>array('view','id'=>$model->id_carrito),
	'Update',
);

$this->menu=array(
	array('label'=>'List TCarrito', 'url'=>array('index')),
	array('label'=>'Create TCarrito', 'url'=>array('create')),
	array('label'=>'View TCarrito', 'url'=>array('view', 'id'=>$model->id_carrito)),
	array('label'=>'Manage TCarrito', 'url'=>array('admin')),
);
?>

<h1>Update TCarrito <?php echo $model->id_carrito; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>