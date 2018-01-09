<?php
/* @var $this TProductoCategoriaController */
/* @var $model TProductoCategoria */

$this->breadcrumbs=array(
	'Tproducto Categorias'=>array('index'),
	$model->id_producto_categoria=>array('view','id'=>$model->id_producto_categoria),
	'Update',
);

$this->menu=array(
	array('label'=>'List TProductoCategoria', 'url'=>array('index')),
	array('label'=>'Create TProductoCategoria', 'url'=>array('create')),
	array('label'=>'View TProductoCategoria', 'url'=>array('view', 'id'=>$model->id_producto_categoria)),
	array('label'=>'Manage TProductoCategoria', 'url'=>array('admin')),
);
?>

<h1>Update TProductoCategoria <?php echo $model->id_producto_categoria; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>