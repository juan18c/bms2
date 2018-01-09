<?php
/* @var $this TProductoTipoController */
/* @var $model TProductoTipo */

$this->breadcrumbs=array(
	'Tproducto Tipos'=>array('index'),
	$model->id_producto_tipo=>array('view','id'=>$model->id_producto_tipo),
	'Update',
);

$this->menu=array(
	array('label'=>'List TProductoTipo', 'url'=>array('index')),
	array('label'=>'Create TProductoTipo', 'url'=>array('create')),
	array('label'=>'View TProductoTipo', 'url'=>array('view', 'id'=>$model->id_producto_tipo)),
	array('label'=>'Manage TProductoTipo', 'url'=>array('admin')),
);
?>

<h1>Update TProductoTipo <?php echo $model->id_producto_tipo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>