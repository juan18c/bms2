<?php
/* @var $this TProductoController */
/* @var $model TProducto */

$this->breadcrumbs=array(
	'Tproductos'=>array('index'),
	$model->id_producto=>array('view','id'=>$model->id_producto),
	'Update',
);

$this->menu=array(
	array('label'=>'List TProducto', 'url'=>array('index')),
	array('label'=>'Create TProducto', 'url'=>array('create')),
	array('label'=>'View TProducto', 'url'=>array('view', 'id'=>$model->id_producto)),
	array('label'=>'Manage TProducto', 'url'=>array('admin')),
);
?>

<h1>Update TProducto <?php echo $model->id_producto; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'modelInventario'=>$modelInventario)); ?>